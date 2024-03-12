<?php
namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;
use App\Models\categories;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mail;


class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('backend.user.register');

    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'Email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'contact' => 'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Validation passed, proceed to create user
        $user = new User();
        $user->name = $request->name;
        $user->Email = $request->Email; // Corrected to match the validation rule
        $user->password = bcrypt($request->password);
        $user->contact = $request->contact;
        $user->status = 1;
        $user->role_id = 6;
        $user->save();

        return redirect('/')->with('success', 'Registration successful. You can now login.');
    }


    public function showLoginForm()
    {
        return view('backend.user.login');

    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Check if the authenticated user has the role ID 6
            if ($user->role_id == 6) {
                return redirect()->route('user.user_dashboard');
            } else {
                Auth::logout();
                return redirect()->route('user.login')->with('error', 'You do not have permission to access this dashboard.');
            }
        } else {
            return redirect()->route('user.login')->with('error', 'Invalid login details');
        }
    }
    
    

    public function user_dashboard()
    {  
        $user = Auth::user();
        return view('backend.user.dashboard', ['user' => $user]);


    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }


    public function User_profile(string $id)
    {
        $data = user::find($id);
        $categories = categories::all();
        $states = State::all();
        $user = auth()->user();
        return view('backend.user.profile', compact('user','states','categories','data'))->with('data', $data);

    }


    public function User_update(Request $request,string $id)
    {
        
        $user = auth()->user();
       // Handle image upload if provided
        if ($request->hasFile('image')) {
            $complaintFile = $request->file('image');
    
            // Validate the uploaded file
            if ($complaintFile->isValid()) {
                // Generate a new unique filename to prevent overwriting
                $compfilenew = md5($complaintFile->getClientOriginalName()) . '.' . $complaintFile->getClientOriginalExtension();
    
                // Move the file to the desired location
                if ($complaintFile->move(public_path('user'), $compfilenew)) {
                    // Update user's image path in the database
                    $user->image = $compfilenew;
                } else {
                    // Handle the case where file could not be moved, perhaps by displaying an error message to the user
                    return back()->withErrors(['file' => 'Error occurred while uploading the file']);
                }
            }else{
                // Handle the case where the uploaded file is not valid, perhaps by displaying an error message to the user
                return back()->withErrors(['file' => 'Invalid file']);
            }
        } else {
            // Handle the case where no file is uploaded, perhaps by displaying an error message to the user
            return back()->withErrors(['file' => 'No file uploaded']);
        }
    
        // Update user data
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->contact = $request->input('contact');
        $user->address = $request->input('address');
        $user->State = $request->input('State');
        $user->country = $request->input('country');
        $user->pincode = $request->input('pincode');
      
        // Save changes to the database
        $user->save();
    
        return redirect()->route('user.user_dashboard')->with('success', 'Profile updated successfully');
    }
    
    public function showProfile()
    {
        $user = auth()->user();
        $userphoto = Auth::user()->userImage;
        return view('backend.user.image-update', compact('userphoto','user'));


    }
   


    public function change_password()
    {
        $user = Auth::user();
        $users = Auth::user();
        return view('backend.user.change-passwrod', compact('users','user'));


    }

    public function updatePassword(Request $request)
    {
        if (Auth::guest()) {
            return redirect()->route('login_register');
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
            return redirect()->route('change_password')->with('success', 'Password updated successfully');
        } else {
            return redirect()->route('change_password')->with('error', 'Old Password does not match!');
        }


}
}
