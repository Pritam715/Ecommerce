<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Banner;
use App\Models\Wishlist;
use App\Models\Offer;
use App\Models\ProductImage;
use App\models\ProductAttributes;
use DB;
use Session;
use Illuminate\Support\Facades\Input;

class FrontendController extends Controller
{

    public function __construct()
    {
        $categories=category::with('subcategories')->with('subsubcategories')->where('status','1')->get();
        // dd($categories);
        
        view()->share([
            'categories'=> $categories,
 
          ]);
    }


    public function index()
    {

        $latest_promo=Offer::where('status','1')->orderBy('id','desc')->get();
        $promo=Offer::where('status','1')->orderBy('id','desc')->get();
        $Slider=Banner::where('status','1')->get();
        $featured=Product::where('featured','1')->inRandomOrder()->get();
        $categories=category::all();
        $products=Product::where('featured','1')->get();
        return view('Frontend.index',compact('categories','products','Slider','featured','promo','latest_promo'));
    }





    //----Product Ddetails-----//
    public function details($slug)
    {

        $details=DB::table('products')->where('slug',$slug)->first();
        $id=$details->id;
        $details=Product::find($id);
        $images=ProductImage::where('product_id',$id)->get();
        $attributes=ProductAttributes::where('product_id',$id)->get();
        return view('Frontend.product_details',compact('details','attributes','images'));
    }


    
    public function findsize(Request $request)
    {
        $data=ProductAttributes::select('sku','size','price','stock')->where('color',$request->color)->get();
        return response()->json($data);
    }


    public function cart(Request $request)
   { 

      $data=$request->all();
          $cart=new Cart;
          $count=Cart::where('product_id',$data['product_id'])->count();
          if($count > 0 )
          {
            return redirect()->back();
          } 
          else{
            $cart->product_id=$data['product_id'];
            $cart->product_name=$data['product_name'];
            $cart->product_image=$data['product_image'];
            $cart->product_code=$data['product_code'];
            $cart->color=$data['color'];
            $cart->size=$data['size'];
            $cart->sku=$data['sku'];
   
            if($cart->size)
            {
             $cart->price=$data['latestprice'];
            }
             else
             {
              $cart->price=$data['price'];
             }
  
 
 
             if(Session::has('frontSession'))
             {
          
               $cart->user_email =Session::get('frontSession');
             }
             else
             {
               $cart->user_email='';
             }
    
      
           if(empty($session_id))
           { 
             $session_id = str_random(40);
             Session::put('session_id',$session_id);

           }
           
           $session_id=Session::get('session_id');
           $cart->session_id=$session_id;
        
            $cart->quantity=$data['quantity'];
            $cart->save();
            return response()->json($cart); 
            return view('Frontend.cart.index');
         
          } 
     
    }

      public function wishlist(Request $request)
      {
        
        if(Session::has('frontSession'))
          {         
                 $data=$request->all();
                 $wishlist=new Wishlist;
                  $wishlist->product_id=$data['product_id'];
                  $wishlist->product_name=$data['product_name'];
                  $wishlist->product_code=$data['product_code'];
                  $wishlist->product_image=$data['product_image'];
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
           
           
           
                   if(Session::has('frontSession'))
                   {
                
                     $wishlist->user_email =Session::get('frontSession');
                   }
                   else
                   {
                     $wishlist->user_email='';
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
                  return view('Frontend.wishlist.index');



             }
             else{
              return response()->json('login'); 
             }     
      
      }



      //cart

      public function allcart()
      {
        $user_email=Session::get('frontSession');
        $session_id=Session::get('session_id');
        $cart=Cart::where('session_id',$session_id)->orWhere('user_email',$user_email)->get();
        return view('Frontend.cart.index',compact('cart'));
      }
    
 



}
