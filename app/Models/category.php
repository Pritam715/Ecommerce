<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    public function subcategories(){
        return $this->hasmany('App\Models\SubCategory','category_id');
    }

    public function subsubcategories(){
        return $this->hasmany('App\Models\Subsubcategory','category_id');
    }
}
