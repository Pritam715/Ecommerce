<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Brand;
use App\Models\Product;
use DB;
use Session;
class ShopController extends Controller
{
    
    public function __construct()
    {
        $categories=category::with('subcategories')->with('subsubcategories')->where('status','1')->get();
        $brands=Brand::get();
        
        view()->share([
            'categories'=> $categories,
            'brands'=>$brands,
 
          ]);
    }
    
   //-----All Products-----//
   public function allproducts()
   {
      $allproducts=Product::inRandomOrder()->get();
     return view('Frontend.product.allproducts',compact('allproducts'));
   }

   
   public function get_causes_against_category(Request $request)
   { 
   
      console.log($request->brand);
    // $data = DB::table('subcategories as sub_cat')->selectRaw('(Select image from categories where id = sub_cat.category_id) as cat_image,  (Select title from categories where id = sub_cat.category_id) as cat_title')->whereRaw('category_id IN ('.$id.')')->get();
      //  $data = Product::whereIn('sub_subcategory_id',$request->id)->orWhereIn('product_brand',$request->brand)->inRandomOrder()->get();
      $data = Product::whereIn('sub_subcategory_id',$request->id)->orWhere('product_brand',$request->brand)->inRandomOrder()->get();

      Session::push('sub_subcategory_id',$request->id);


      return json_encode($data);
    }

    public function findProducts(Request $request)
    {
      
      $sub_subcategory_id= Session::get('sub_subcategory_id');

      if($request->sort == 'high')
      { 
      //  $data=Product::where('sub_subcategory_id',$sub_subcategory_id)->get();
      $data=Product::where('sub_subcategory_id', $sub_subcategory_id)->orderBy('product_price','asc')->get();
       }
       if($request->sort == 'low')
       { 
       $data=Product::where('sub_subcategory_id', $sub_subcategory_id)->orderBy('product_price','desc')->get();
        }
     
        if($request->sort == 'default')
        { 
        $data=Product::where('sub_subcategory_id', $sub_subcategory_id)->inRandomOrder()->get();
         }
        return response()->json($data);//then sent this data to ajax success
      
    
    }
      
}
