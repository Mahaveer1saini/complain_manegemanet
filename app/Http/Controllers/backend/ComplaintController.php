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

        // Fetch subcategories for each category
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
            'state' => 'required',
            'noc' => 'required',
            'complaint_details' => 'required',
            'complaint_file' => 'required',
            'district'=>'required',
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
        $complaint->state = $validatedData['state'];
        $complaint->noc = $validatedData['noc'];
        $complaint->complaint_details = $validatedData['complaint_details'];
        $complaint->complaint_file = $compfilenew;
        $complaint->district = $validatedData['district'];
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
        $complaints = Complaint::all(); // Assuming you have a Complaint model
        return view('backend.user.complain-history', compact('complaints'),['user' => $user]);
    }


        public function complaint_show($id)
        {
            $user = Auth::user();
            $data = User::find($id);
            $complaint = Complaint::with(['user', 'category'])
                ->where('user_id', $id)
                ->firstOrFail();

            $remarks = $complaint->remarks()->orderBy('created_at', 'desc')->get();

            return view('backend.user.complain-show', compact('complaint', 'data'),['user' => $user]);


        }




}

