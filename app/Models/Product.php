<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'details',
        'subcategory_id',
        "is_favorite",
        "is_cart",
        "offer_id",
        'regular_price',
        'sale_price',
        'active',
        'quantity',
        'image',
         "link"
    ];

    public function subCategory(){
        return $this->belongsTo(SubCategory::class,"subcategory_id");
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details');
    }

    public $timestamps = false;

      public function offer(){
    return $this->belongsTo(Offer::class,'offer_id');
  }
   public function Colors(){
    return $this->belongstoMany(color::class,'color_products',"product_id","color_id");
  }

}
