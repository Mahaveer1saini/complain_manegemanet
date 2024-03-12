<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategories extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'subcategory'];

    public function category()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }
   
}
