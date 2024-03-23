<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
class homeController extends Controller
{
    
    public function fornt_theme()
    {
        $data = Complaint::all();
        return view('welcome',compact('data'));
    
    }

    public function ajaxRequest(Request $request){
       $post = Complaint::find($request->id);
        $response = auth()->user()->toggleLike($post);
        return response()->json(['success'=>$response]);
    }
}
