<?php

namespace App\Models;
use Path\To\CanBeLiked;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;





class Complaint extends Model
{
    use HasFactory;
   

    

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

  
    public function followers()
    {
        return $this->morphToMany(User::class, 'followable');
    }
}
