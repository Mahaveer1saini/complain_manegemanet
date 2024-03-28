<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    
    public function fornt_theme()
    {
        $data = Complaint::all();
        return view('welcome',compact('data'));
    
    }

   



    public function like(Request $request, $complaintId)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            } else {
                // Redirect the user to the login page
                return redirect()->route('user.login');
            }
        }
    
        // If user is authenticated, proceed with like action
        $userId = auth()->id();
        $like = Like::where('user_id', $userId)
                    ->where('complaint_id', $complaintId)
                    ->where('rating_action', 'like')
                    ->first();
    
        if ($like) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Already liked'], 400);
            } else {
                return redirect()->route('home')->with('error', 'Already liked');
            }
        } else {
            Like::create([
                'user_id' => $userId,
                'complaint_id' => $complaintId,
                'rating_action' => 'like'
            ]);
    
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Liked successfully']);
            } else {
                return redirect()->route('home')->with('success', 'Liked successfully');
            }
        }
    }
    
    public function dislike(Request $request, $complaintId)
    {
        $userId = auth()->id();
        
        // Check if the user has previously disliked the complaint
        $dislike = Like::where('user_id', $userId)
                        ->where('complaint_id', $complaintId)
                        ->where('rating_action', 'dislike')
                        ->first();
    
        if ($dislike) {
            // If the user has already disliked, remove the dislike
            $dislike->delete();
    
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Changed to like']);
            } else {
                return redirect()->route('home')->with('success', 'Changed to like');
            }
        } else {
            // Check if the user has previously liked the complaint
            $like = Like::where('user_id', $userId)
                        ->where('complaint_id', $complaintId)
                        ->where('rating_action', 'like')
                        ->first();
            
            if ($like) {
                // If the user has previously liked, remove the like
                $like->delete();
            }
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Disliked successfully']);
            } else {
                return redirect()->route('home')->with('success', 'Disliked successfully');
            }
        }
    }
    
    
    


   

}

   


