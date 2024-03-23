<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Sortable, HasRoles;
    
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'role_id',
        'password',
        'contact',
        'address',
        'username',
        'State',
        'country',
        'pincode',
        'image',
        'status',
    ];

      protected $dates = [
        'regDate',
        'updationDate',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function complaintremark()
    {
        return $this->belongsTo(complaintremark::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followedComplaints()
    {
        return $this->morphedByMany(Complaint::class, 'followable');
    }
}
