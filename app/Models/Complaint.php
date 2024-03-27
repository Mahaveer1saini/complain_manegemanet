<?php

namespace App\Models;
use Path\To\CanBeLiked;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Conner\Likeable\Likeable;
use Illuminate\Support\Facades\Auth;





class Complaint extends Model
{
    use HasFactory,Likeable;
    

    

    protected $table = 'tblcomplaints';

    protected $fillable = [
        'user_id',
        'category',
        'subcategory',
        'complaint_type',
        'state',
        'noc',
        'complaint_details',
        'complaint_file',
        'city',
        'tehsil',
        'village',
        'word',
        'city',
        'status',
        'country',
       
       
        


    ];

    // Define any relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(categories::class);
    }
    public function remarks()
    {
        return $this->hasMany(State::class, 'id');
    }

    public function Complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function complaintremark()
    {
        return $this->hasMany(complaintremark::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Method to like the post
    public function like()
    {
        // Assuming you have a Like model with user_id and complaint_id columns
        $this->likes()->create(['user_id' => Auth::id()]);
    }

  
    
}
