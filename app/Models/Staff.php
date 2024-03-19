<?php

namespace App\Models;

use DateTimeInterface;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory, Sortable;
    
    protected $table = 'staffs';

    protected $fillable = [
        'staff_uni_id',
        'country',
        'state',
        'city',
        'phone_no',
        'name',
        'email',
        'password',
        'birth_date',
        'gender',
        'age',
        'staff_img',
        'api_key',
        'user_uni_id',
        'status',
        'update_profile_status',
        'latitude',
        'longitude',
        'birth_time',
        'birth_place',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // protected $casts = [
    //     'created_at' => 'datetime',
    //     'updated_at' => 'datetime',
    // ];
    
    public $timestamps = false;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    
   
    public function user()
    {
        return $this->belongsTo(User::class, 'staff_uni_id', 'user_uni_id');
    }
   

    public $sortable = ['staff_uni_id',];
}
