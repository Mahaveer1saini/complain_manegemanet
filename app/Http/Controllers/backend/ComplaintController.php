<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\categories;
use App\Models\State;
use App\Models\User;
use App\Models\subcategories;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{


    public function complaint()
    {
        $user = Auth::user();
        $categories = categories::all();
        $states = State::all();
        $subcategories = [];
        foreach ($categories as $category) {
            $subcategories[$category->id] = subcategories::where('category_id', $category->id)->get();
        }

       return view('backend.user.register-complaint', compact('categories', 'states', 'subcategories'))->with('user', $user);

    }



    public function getSubCategory(Request $request)
    {
        $categoryId = $request->input('categoryId');
        $subcategories = subcategories::where('categoryid', $categoryId)->get();

        $options = '<option value="">Select Subcategory</option>';
        foreach ($subcategories as $subcategory) {
            $options .= '<option value="'.$subcategory->id.'">'.$subcategory->name.'</option>';
        }

        return $options;
    }

    // public function getSubcategories(Request $request)
    // {
    //     $categoryId = $request->input('catid');

    //     if (!is_numeric($categoryId)) {
    //         return response()->json(['error' => 'Invalid industryid']);
    //     }

    //     $subcategories = Subcategory::where('categoryid', $categoryId)->pluck('subcategory');

    //     return response()->json($subcategories);
    // }



    public function submitComplaint(Request $request)
    {
        
       
        // Validate the incoming request data and assign it to $validatedData
        $validatedData = $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'complaintype' => 'required',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' =>'nullable',
            'noc' => 'required',
            'complaint_details' => 'required',
            'complaint_file' => 'required',
            'tehsil'=>'required',
            'village'=>'required',
            'word'=>'required',
             // Example validation for file upload
        ]);
  
        // Handle file upload
        if ($request->hasFile('complaint_file')) {
            $complaintFile = $request->file('complaint_file');
            // Generate a new unique filename to prevent overwriting
            $compfilenew = md5($complaintFile->getClientOriginalName()) . '.' . $complaintFile->getClientOriginalExtension();
            // Move the file to the desired location
            $complaintFile->move(public_path('complaintdocs'), $compfilenew);
        } else {
            // Handle the case where no file is uploaded, perhaps by displaying an error message to the user
            return back()->withErrors(['file' => 'No file uploaded']);
        }
        // Save complaint to database
        $complaint = new Complaint();
        $complaint->user_id = auth()->id(); // Assuming you are using Laravel's authentication
        $complaint->category = $validatedData['category'];
        $complaint->subcategory = $validatedData['subcategory'];
        $complaint->complaint_type = $validatedData['complaintype'];
        $complaint->country = $validatedData['country'];
        $complaint->state = $validatedData['state'];
        $complaint->city = $validatedData['city'];
        $complaint->noc = $validatedData['noc'];
        $complaint->complaint_details = $validatedData['complaint_details'];
        $complaint->complaint_file = $compfilenew;
        $complaint->tehsil = $validatedData['tehsil'];
        $complaint->village = $validatedData['village'];
        $complaint->word = $validatedData['word'];
        $complaint->save();

        // Other operations like fetching complaint number can be added here
        return redirect()->route('user.user_dashboard')->with('success', 'Profile updated successfully');
    
    }


    public function complaint_history()
    {
     
        $user = Auth::user();
        $complaints = Complaint::where('user_id', $user->id)->get();
        return view('backend.user.complain-history', compact('complaints', 'user'));
    }


    public function complaint_show($id)
    {
      $user = Auth::user();
      $complaint = Complaint::find($id);
      return view('backend.user.complain-show',compact('complaint','user'));
    }

        
    public function complaint_update($id)
    {
      $user = Auth::user();
      $categories = categories::all();
      $states = State::all();
      $Complaint = Complaint::find($id);
      $subcategories = [];
        foreach ($categories as $category) {
            $subcategories[$category->id] = subcategories::where('category_id', $category->id)->get();
        }
      return view('backend.user.complain-update', compact('Complaint','categories','states','user','subcategories'));
     
    }

    public function complaint_edit(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'complain_type' => 'required',
            'birth_place' => ['required'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'country' => ['nullable'],
            'noc' => 'required',
            'complaint_details' => 'required|max:20',
            'complaint_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'tehsil' => 'required',
            'village' => 'required',
            'word' => 'required|numeric',
           
        ]);
    
        // Find the complaint record by ID
        $complaint = Complaint::findOrFail($id);
    
        $complaint->country = $request->input('country');
        $complaint->state = $request->input('state');
        $complaint->city = $request->input('city');
        $complaint->category = $request->input('category');
        $complaint->subcategory = $request->input('subcategory');
        $complaint->complaint_type = $request->input('complaint_type');
        $complaint->noc = $request->input('noc');
        $complaint->complaint_details = $request->input('complaint_details');
    
        // Handle file upload if necessary
        if ($request->hasFile('complaint_file')) {
            $image = $request->file('complaint_file');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $complaint->complaint_file = $imageName;
        }
        $complaint->tehsil = $request->input('tehsil');
        $complaint->village = $request->input('village');
        $complaint->word = $request->input('word');
        
        // Save the updated complaint record
        $complaint->save();
    
        // Redirect the user back or to another page after successful edit
        return redirect()->route('user.complaint-history');
    }

    public function complaint_destroy($id)
    {
      $Complaint = Complaint::find($id);
      $Complaint->delete();
      return redirect()->route('user.complaint-history')
        ->with('success', 'Complaint deleted successfully');
    }
    
     
    }

    




