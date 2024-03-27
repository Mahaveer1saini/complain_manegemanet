<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
class homeController extends Controller
{
    
    public function fornt_theme()
    {
        $data = Complaint::all();
        return view('welcome',compact('data'));
    
    }

    public function likePost($id)
    {
        if(!empty(Auth::id())){
            $post = Complaint::find($id);
            $existingLike = $post->likes()->where('user_id', Auth::id())->first();
            if ($existingLike) {
                return redirect()->route('home')->with('error', 'You have already liked this post!');
            }
            $post->like(); 
            $post->save();
            return redirect()->route('home')->with('message', 'Post liked successfully!');

        }else{
            return redirect()->route('user.login');
        }
    }

    public function unlikePost($id)
{
    $post = Complaint::find($id);
    
    // Decrease the likes count by 1
    $post->likes_count = max(0, $post->likes_count - 1);
    
    // Save the changes
    $post->save();
    
    // Redirect back to home page with a success message
    return redirect()->route('home')->with('message', 'Post Like undone successfully!');
}

   
    
}

