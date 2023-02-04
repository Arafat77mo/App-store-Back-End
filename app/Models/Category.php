<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'active',
        "image"
    ];

      public function subcatrgories(){
        return $this->hasMany(SubCategory::class,'category_id');
    }
}
