<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    

    protected $fillable = ['sub_name','photo','category_id','active'];


   
      public function Categories(){
        return $this->belongsto(Category::class,'category_id');
    }



}
