<?php

namespace App\Http\Controllers\Backend;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Complaint;
use App\Models\categories;
use App\Models\subcategories;
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
use App\DataTables\Backend\CustomerDataTable;
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
        // Define and initialize $all_user variable
    
        // Check if the user is not logged in, redirect to login page
        if (Auth::guest()) {
            return redirect()->route('admin.login');   
        }
    
        if ($loggedUser->role_id == 2) {
            // Count all users with role_id 6 (assuming this is the State role)
            $all_user = User::where('role_id', 7)->count();
            $all_state = State::count();
            $all_Complaint = Complaint::count();
            $closedComplaintCount = Complaint::where('status', 'closed')->count();
            $paddingComplaintCount = Complaint::where('status', 'padding')->count();
            $processComplaintCount = Complaint::where('status', 'in process')->count();
            $all_categories = categories::count();
            $all_subcategories = subcategories::count();  // Count all states
            $data = (object) [];
            if ($loggedUser->package_valid_date <= Config::get('current_date')) {
                if ($loggedUser->role_id == 2) {
                    return view('Admin.dasboard', compact('data', 'all_user', 'all_state','all_Complaint','all_categories','all_subcategories','closedComplaintCount','paddingComplaintCount','processComplaintCount'))->with('error', 'Your plan has expired. Please recharge immediately');
                } else {
                    return view('backend.users.dashboard', compact('data'))->with('error', 'Your admin plan has expired. Contact an Authorized Person');
                }
            } else {
                return view('backend.users.dashboard', compact('data'));
            }
        } elseif ($loggedUser->role_id == 1) {
            // Count total admins and fetch a list of admins
            $total_admin = User::where('role_id', config('constants.admin_role_id'))->count();
            $admins_list = User::where('role_id', config('constants.admin_role_id'))->where('status', 1)->take(5)->orderBy('id', 'desc')->get();
    
            // Count all users
           
            
            // Debugging statement to check if $states is returning the expected result
          
            // Create data object to pass to view
            $data = (object) [
                'total_admin' => $total_admin,
                'admins_list' => $admins_list,
            ];
    
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

        if (Auth::attempt($attributes)) {
            $loggedUser = Auth::user();
            
            if ($loggedUser->role_id == 2) {
             return redirect()->route('admin.dashboard')->with(['success' => 'You are logged in.']);
            } elseif ($loggedUser->role_id == 3) {
                return redirect()->route('mp.dashboard')->with(['success' => 'You are logged in.']);
            } elseif ($loggedUser->role_id == 4) {
                return redirect()->route('mla.dashboard')->with(['success' => 'You are logged in.']);
            } elseif ($loggedUser->role_id == 5) {
                return redirect()->route('sarpanch.dashboard')->with(['success' => 'You are logged in.']);
            } elseif ($loggedUser->role_id == 6) {
                return redirect()->route('member.dashboard')->with(['success' => 'You are logged in.']);
            } else {
                return back()->withErrors(['email' => 'Unknown role.']);
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
    public function userList(CustomerDataTable $dataTable)
    {
       
       
        $users = User::where('role_id', 7)->get();
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
       
        $complaint = Complaint::findOrFail($id);
        $status = $request->input('status');
        $remark = $request->input('remark');
        $user_id = auth()->id(); 
        
        // Save remark
        $rr =   ComplaintRemark::create([
            'complaint_id' => $complaint->id, // Use complaint's ID
            'user_id' => $user_id,
            'status' => $status,
            'remark' => $remark
        ]);
    // dd($rr);
        // Update complaint status
        $complaint->update(['status' => $status]);
    
        return redirect()->route('admin.all-complaint')->with('success', 'Complaint details updated successfully');
    } 
    
    
        
  
    


    // Method to close the window
  


    public function admin_ragister()
    {
        if (!Auth::guest()) {
           
            return redirect()->route('admin.dashboard'); // Added semicolon and closed the if statement properly
        }
        $roles = Role::where('status', 1)
        ->whereNotIn('role_type', ['superadmin', 'admin'])
        ->get();
       // If the user is a guest, it might be a good idea to retrieve all roles
        return view('Admin.registor', ['roles' => $roles]);
        
    }
 
    public function customer_ragister(Request $request)
    {
        if (!Auth::guest()) {
            return redirect()->route('admin.dashboard');
        }
    
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'username' => ['required', 'max:50', Rule::unique('users', 'username')],
            'password' => ['required', 'min:5', 'max:20'],
            'role_id' => 'required',
        ]);
    
        // Hash the password
        $validatedData = $request->all();
        $validatedData['password'] = bcrypt($request->password);
    
        // Store data in the database
        User::create($validatedData);
    
        return redirect()->route('admin.login');
    }
    
   

    public function search_filter(Request $request)
    {
        $limit =  config('constants.pagination_page_limit');
        $filter = $request->query();
        $thismodel = user::sortable(['user.created_at' => 'desc']);
        
        $thismodel->select([
            'users.*', 'users.created_at', 'users.name', 'users.email','users.status',
        ]);


        $keyword = '';
        if (isset($filter['status']) && $filter['status'] != "") {
            $thismodel->where('status', $filter['status']);
        }
        if (!empty($filter['search'])) {
            $keyword    =   $filter['search'];
            $thismodel->where(function ($query) use ($keyword) {
                $query->where('users.name', 'LIKE', '%' . $keyword . '%')->orwhere('users.name', 'LIKE', '%' . $keyword . '%')->orwhere('users.email', 'LIKE', '%' . $keyword . '%')->orwhere('users.contact', 'LIKE', '%' . $keyword . '%');
            });
        }

        if (!empty($filter['start_date']) ) {
            $start_date_format = mysqlDateFormat($filter['start_date']);
            $thismodel->whereDate('users.created_at', '>=', $start_date_format);
        }
        if (!empty($filter['end_date'])) {
            $end_date_format = mysqlDateFormat($filter['end_date']);
            $thismodel->whereDate('users.created_at', '<=', $end_date_format);
        }
        // dd(getQueryWithBindings($thismodel));

       

        if (isset($filter['excel_export']) || isset($filter['pdf_export'])) {

            $headings = [
                "users id", "Role_id", "Name", "email", "contact",
             
               
                
            ];
            $thismodel->select([
                 "users.id",
                 'users.role_id', 'users.name', 'users.email', 'users.contact',
                 'users.country', 'users.status',
                 'users.status', 'users.created_at', 'users.updated_at',
            ]);

            $records = $thismodel->get();

            if (isset($filter['excel_export'])) {
                return Excel::download(new ExportUser($records, $headings), 'Customers.xlsx');
            } else if (isset($filter['pdf_export'])) {
                $tabel_keys = [];
                if ($records->count() > 0) {
                    $tabel_keys = array_keys($records[0]->toArray());
                }

                $variabls = [
                    'top_heading' => 'Customer List',
                    'headings' => $headings,
                    'tabel_keys' => $tabel_keys,
                    'records' => $records,
                ];

                $file = 'Customers.pdf';
                $pdf =  PDF::loadview('pdf', $variabls);
                if (count($headings) > 6) {
                    $pdf->setPaper('a4', 'landscape');
                }

                return $pdf->download($file);
            }
        }
        $customers = $thismodel->paginate($limit);
        return view('backend.customer.index', compact('customers', 'filter'))->with('i', (request()->input('page', 1) - 1) * $limit);
    }

        
       
    }
    
    

