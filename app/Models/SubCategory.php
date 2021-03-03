<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table="sub_categories";
    


       public function category()
        {
            return $this->belongsTo('App\Models\category');
        }
    
        public function subsubcategories(){
            return $this->hasmany('App\Models\Subsubcategory','sub_category_id');
        }
}
