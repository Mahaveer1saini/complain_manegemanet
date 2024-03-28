<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Conner\Likeable\Likeable;
use Illuminate\Support\Facades\Auth;





class Complaint extends Model
{
    use HasFactory;
    protected $table = 'tblcomplaints';

    protected $fillable = [
        'user_id',
        'category',
        'subcategory',
        'complaint_type',
        'noc',
        'complaint_details',
        'complaint_file',
        'tehsil',
        'village',
        'word',
        'country',
        'state',
        'city',
        'status',
       
       
       
        


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

    public function like()
    {
       $this->likes()->create(['user_id' => Auth::id()]);
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'complaint_id');
    }


  
    
}
