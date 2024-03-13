<?php

namespace App\Http\Controllers\Backend;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Complaint;
use App\Models\complaintremark;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Models\AstrologerInformation;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Password;
// use Illuminate\Auth\Events\PasswordReset;
use App\Console\Commands\MyCommand;
use URL;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // 
    //::put('variableName', $request->input("idevento"));

    public function index(Request $request)
    {

        $loggedUser = Auth::user();
        $limit =  config('constants.pagination_page_limit');
        $thismodel = User::latest()->with('role');

        if (isset($filter['sort']) && in_array($filter['sort'], ['name'])) {
            $thismodel = User::orderBy('users.' . $filter['sort'], $filter['direction']);
        } elseif (isset($filter['sort'])) {
            $thismodel = User::sortable();
        } else {
            $thismodel = User::orderBy('users.id', 'desc');
        }

        if ($loggedUser->role_id > 1) {
            $thismodel->where('role_id', '>', $loggedUser->role_id);
        }

        $users = $thismodel->paginate($limit);
        return view('backend.users.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * $limit);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all();
        $state = State::all();
        $city = City::all();
        $category = Category::all();
        $LoggedUser = Auth::user();
        $roles = Role::orderBy('name')->where('id', '>', $LoggedUser->role_id)->get();
        $users = User::orderBy('name')->where('id', '>', $LoggedUser->role_id)->get();



        $country = Country::all();
        return view('backend.users.create', compact('roles', 'users', 'state', 'city', 'category'));
    }

    
   
    public function dashboard(User $user)
    {     
        $loggedUser = Auth::user();
        $all_user = 0; // Define and initialize $all_user variable
    
        if (Auth::guest()) {
            return redirect()->route('admin.login');   
        }
      
        if ($loggedUser->role_id == 2) {
            $all_user = User::where('role_id', 6)->count();
            $data = (object) [];
            if ($loggedUser->package_valid_date <= Config::get('current_date') && $loggedUser->role_id == 2) {
              return view('Admin.dasboard', compact('data','all_user'))
              ->with('error', 'Your plan has expired. Please recharge immediately');
            } elseif (($parent->package_valid_date <= Config::get('current_date')) && $loggedUser->role_id > 2) {
                return view('backend.users.dashboard', compact('data'))->with('error', 'Your admin plan has expired. Contact an Authorized Person');
            } else {
                return view('backend.users.dashboard', compact('data'));
            }
        } elseif ($loggedUser->role_id == 1) {
            $total_admin = User::where([['role_id', config('constants.admin_role_id')]])->count();
            $admins_list = User::where([['role_id', config('constants.admin_role_id')], ['status', 1]])->take(5)->orderBy('id', 'desc')->get();
    
            $all_user = User::count(); // Count all users
    
            $data = (object)array(
                'total_admin' => $total_admin,
                'admins_list' => $admins_list,
                'all_user' => $all_user // Pass all_user to the view
            );
    
            return view('backend.users.superadmin-dashboard', compact('data'));
        }
    }
    
    
    
    

    public function register()
    {
        if (!Auth::guest()) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.users.register');
    }

    public function registerStore()
    {
        if (!Auth::guest()) {
            return redirect()->route('admin.dashboard');
        }
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'username' => ['required', 'max:50', Rule::unique('users', 'username')],
            'password' => ['required', 'min:5', 'max:20'],
        ]);
        $attributes['pstr'] = $attributes['password'];
        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);
        return redirect()->route('admin.login');
    }

    public function login()
    {  

       if (!Auth::guest()) {
            return redirect()->route('admin.dashboard');
        }
        return view('Admin.login');
    }

    public function loginStore(Request $request)
    {   
        if (!Auth::guest()) {
            return redirect()->route('admin.dashboard');
        }
    
        $attributes = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
    
        if (filter_var($attributes['username'], FILTER_VALIDATE_EMAIL)) {
            $attributes['email'] = $attributes['username'];
            unset($attributes['username']);
        }
    
        if (Auth::attempt($attributes)) {
            $roles = Role::where('id', '=', Auth::user()->role_id)->first();
            if (!$roles->status) {
                Auth::logout();
                return back()->with('error', 'Your role is inactive');
            }
            if (!Auth::user()->status) {
                Auth::logout();
                return back()->with('error', 'Your account is inactive');
            }
    
            $loggedUser = Auth::user();
    
            if ($loggedUser->role_id > 1) {
                if ($loggedUser->package_valid_date < Config::get('current_date') && $loggedUser->role_id == 2) {
                    $result = array(
                        "status" => 0,
                        "message" => 'Your plan expiry. Please recharge immediately'
                    );
                    return redirect()->route('admin.planexpiry', compact('result'));
                } else {
                    return redirect()->route('admin.dashboard')->with(['success' => 'You are logged in.']);
                }
                
            } else {
                return redirect()->route('admin.dashboard')->with(['success' => 'You are logged in.']);
            }
        } else {
            return back()->withErrors(['email' => 'Username or password invalid.']);
        }
    }
    


    


    public function logout()
    {

        Auth::logout();
        return redirect()->route('admin.login')->with(['success' => 'You\'ve been logged out.']);
    }

    public function forgotPassword()
    {
        if (!Auth::guest()) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.users.sendEmail');
    }

    public function changePassword(Request $request)
    {
        if (Auth::guest()) {
            return redirect()->route('admin.login');
        }
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET ? redirect()->route('admin.login')->with('success', __($status)) : back()->withErrors(['email' => [__($status)]]);
    }

    public function adminProfile()
    {
        $users = Auth::user();
        return view('Admin.admin-profile', compact('users'));
       
    }

    public function editProfile()
    {
        if (Auth::guest()) {
            return redirect()->route('admin.login');
        }
        $users = Auth::user();
        return view('Admin.edit-profile', compact('users'));
      
    }

    public function updateProfile(Request $request)
    {
        if (Auth::guest()) {
            return redirect()->route('admin.login');
        }
    
        $rules = [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'username' => ['max:70', Rule::unique('users')->ignore(Auth::user()->id)],
        ];
    
        // Adding contact field validation if present in the request
        if ($request->has('contact')) {
            $rules['contact'] = ['max:50', Rule::unique('users')->ignore(Auth::user()->id)];
        }
    
        $attributes = request()->validate($rules);
    
        $updateData = [
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'username' => $attributes['username'],
        ];
    
        // Adding contact field to update data if present in the request
        if (isset($attributes['contact'])) {
            $updateData['contact'] = $attributes['contact'];
        }
    
        User::where('id', Auth::user()->id)
            ->update($updateData);
    
        return redirect()->route('admin.adminProfile')->with('success', 'Profile updated successfully');
    }
    

    public function AdminChange_password()
    {
        $users = Auth::user();
        return view('Admin.changepassword', compact('users'));
      
    }

    public function AdminUpdatePassword(Request $request)
    {
        if (Auth::guest()) {
            return redirect()->route('admin.login');
        }

        $attributes   =   $request->validate([
            'old_password' => ['required', 'max:50'],
            'password' => ['required', 'max:50'],
            'confirm_password' => ['required', 'same:password', 'max:50'],
        ]);

        $user = Auth::user();
        if (Hash::check($attributes['old_password'], $user->password)) {
            $user->update([
                'password' => Hash::make($attributes['password']),
                'pstr' => $attributes['password']
            ]);
            return redirect()->route('admin.admin_password')->with('success', 'Profile updated successfully');
        } else {
            return redirect()->route('admin.admin_password')->with('error', 'Old Password does not match!');
        }
    }

    public function userList()
    {
        // Assuming you have a 'role_id' column in your users table
        $users = User::where('role_id', 6)->get();
        return view('Admin.user.userlist', compact('users'));
        
    }

    public function destroy(string $id)
    { 
      User::destroy($id);
      return redirect()->route('admin.userList');
    }
    
    public function all_Complaint(Request $request)
    {
        
        $allComplaint = Complaint::all();
        return view('Admin.user.allcomplain', compact('allComplaint'));
    }

    public function Complaint_detail($id)
    {
       
        $complaint = Complaint::find($id);// Assuming you have a model named "Complaint"
        return view('Admin.user.complaint-details', compact('complaint'));
    }


    public function Complaint_Edit($id)
    {
        
        $complaint = Complaint::where('id', $id)->firstOrFail();
        return view('Admin.user.editcomplaint', compact('complaint'));
       
       
        
    }
    public function Complaint_Update(Request $request, $id)
    { 
       
        $complaint_id = $id;
        $status = $request->input('status');
        $remark = $request->input('remark');
        $user_id = auth()->id(); // Get the current user's ID
        
        // Save remark
        ComplaintRemark::create([
            'complaint_id' => $complaint_id,
            'user_id' => $user_id, // Associate the current user's ID with the complaint remark
            'status' => $status,
            'remark' => $remark
        ]);
    
        // Update complaint status
        Complaint::where('id', $complaint_id)
            ->update(['status' => $status]);
    
        return redirect()->back()->with('success', 'Complaint details updated successfully');
    }
    
    
        
  
    


    // Method to close the window
    public function closeWindow()
    {
        // You can put any logic you need here
        return redirect()->back();
    }
}
