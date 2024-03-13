<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class complaintremark extends Model
{
    use HasFactory;
    protected $table = 'complaintremark';
    protected $fillable = [
       'complaint_id',
        'user_id',
        'status',
        
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    

    public function category()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }
    public function Complaint()
    {
        return $this->belongsTo(Complaint::class, 'complaint_id');
    }
   
}
