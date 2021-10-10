<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
     {
         return $this->belongsTo('App\Models\category','category_id');
     }

     
    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategory','subcategory_id');
    }

    
    public function subsubcategory()
     {
         return $this->belongsTo('App\Models\Subsubcategory','sub_subcategory_id');
     }

     
      public function brand()
      {
          return $this->belongsTo('App\Models\Brand','product_brand');
      }
 
      public function productattributes()
      {
          return $this->hasMany('App\Models\ProductAttributes','product_id');
      }

      public function product_images()
      {
          return $this->hasMany('App\Models\ProductImage','product_id');
      }
}
