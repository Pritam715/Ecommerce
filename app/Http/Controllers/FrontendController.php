<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Product;
use App\Models\Cart;
use App\models\ProductAttributes;
use DB;
use Session;
use Illuminate\Support\Facades\Input;

class FrontendController extends Controller
{

    public function __construct()
    {
        $categories=category::with('subcategories')->with('subsubcategories')->where('status','1')->get();
        
        view()->share([
            'categories'=> $categories,
 
          ]);
    }


    public function index()
    {
        $categories=category::all();
        $products=Product::where('featured','1')->get();
        return view('Frontend.index',compact('categories','products'));
    }






    //----Product Ddetails-----//
    public function details($slug)
    {

        $details=DB::table('products')->where('slug',$slug)->first();
        $id=$details->id;
        $details=Product::find($id);
        $attributes=ProductAttributes::where('product_id',$id)->get();
        return view('Frontend.product_details',compact('details','attributes'));
    }


    
    public function findsize(Request $request)
    {
        $data=ProductAttributes::select('size','price','stock')->where('color',$request->color)->get();
        return response()->json($data);
    }


    public function cart(Request $request)
   { 

      $data=$request->all();
          $cart=new Cart;
           $cart->product_id=$data['product_id'];
           $cart->product_name=$data['product_name'];
           $cart->product_code=$data['product_code'];
           $cart->color=$data['color'];
           $cart->size=$data['size'];
  
           if($cart->size)
           {
            $cart->price=$data['latestprice'];
           }
            else
            {
             $cart->price=$data['price'];
            }
 
            if(empty($session_id))
            { 
              $cart->user_email='';
            }
            else{
                $cart->user_email=Session::get('frontSession');
            }

          $session_id=Session::get('session_id');
          $cart->session_id=$session_id;
       
          if(empty($session_id))
          { 
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
          }
           $cart->quantity=$data['quantity'];
           $cart->save();
           return response()->json($cart); 
           return view('Frontend.cart.index');
     
    }



    
    public function wishlist(Request $request)
   { 


      $data=$request->all();
          $wishlist=new Wishlist;
           $wishlist->product_id=$data['product_id'];
           $wishlist->product_name=$data['product_name'];
           $wishlist->product_code=$data['product_code'];
           $wishlist->color=$data['color'];
           $wishlist->size=$data['size'];
  
           if($wishlist->size)
           {
            $wishlist->price=$data['latestprice'];
           }
            else
            {
             $wishlist->price=$data['price'];
            }
 
            if(empty($session_id))
            { 
              $wishlist->user_email='';
            }
            else{
                $wishlist->user_email=Session::get('frontSession');
            }
          $session_id=Session::get('session_id');
          $wishlist->session_id=$session_id;
       
          if(empty($session_id))
          { 
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
          }
           $wishlist->quantity=$data['quantity'];
           $wishlist->save();
           return response()->json($wishlist); 
           return view('Frontend.cart.index');  
     
    }



}
