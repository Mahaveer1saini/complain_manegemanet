<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class complaintremark extends Model
{
    use HasFactory;
    protected $fillable = [
        'complaint_id',
        'user_id',
        'status',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
