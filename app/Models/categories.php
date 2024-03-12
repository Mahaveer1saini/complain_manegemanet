<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = [
        'categoryName',
        'categoryDescription'
    ];

    public function subcategories()
    {
        return $this->hasMany(subcategories::class);
    }
}
