<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\category;
use App\Models\Subsubcategory;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\ProductAttributes;
use Image;

class ProductController extends Controller
{
     public function index()
     {
         $products=Product::orderBy('id','Desc')->get();
         return view('Backend.Product.index',compact('products'));
     }

     public function add()
     {
         $offer=Offer::all();
         $category=category::all();
         $brand=Brand::all();
         return view('Backend.Product.addproduct',compact('category','brand','offer'));
     }

     public function store(Request $request)
     {

    //    dd($request->all());
        $data=$request->all();

        $product= new Product;
        $product->category_id=$data['category_id'];
        $product->subcategory_id=$data['subcategory_id'];
        $product->sub_subcategory_id=$data['subsubcategory_id'];
        $product->product_name=$data['product_name'];
        // dd($data['offer_id']);
        $product->offer_id=$data['offer_id'];
        $product->offer_price=$data['offer_price'];
        $product->slug = str_slug($data['product_name'],"-");
        $product->product_code=$data['product_code'];
        $product->product_brand=$data['product_brand'];
        $product->product_price=$data['product_price'];
        $product->short_description=$data['short_description'];
        $product->long_description=$data['description'];
        $product->status=$data['status'];
        $product->featured=$data['featured'];

    
      
        if ($request->hasFile('image')) {
            $img_tmp=$request->file('image');
            $extension=$img_tmp->getClientOriginalExtension();
            $filename=rand(111,99999).'.'.$extension;
         //   $img_path='public/Images/product/'.$filename;
            Image::make($img_tmp)->resize(540,720)->save(public_path('Images/Product/').$filename);
            $product->product_image=$filename;
           
        }
         $product->save();

         return redirect('products');
     }


     public function edit($id)
     {
        $offer=Offer::all();
         $product=Product::find($id);
         $category=category::all();
         $brand=Brand::all();
         return view('Backend.Product.editproduct',compact('product','category','brand','offer'));
     }


     Public function update(Request $request,$id)
     {
         
     //  dd($request->all());
        $data=$request->all();

        $product= Product::find($id);
        if($data['category_id'])
        {
            $product->category_id=$data['category_id'];
        }
        
        if($data['subcategory_id'])
        {
            $product->subcategory_id=$data['subcategory_id'];
        }
        if($data['subsubcategory_id'])
        {
            $product->sub_subcategory_id=$data['subsubcategory_id'];
        }

        $product->offer_id=$data['offer_id'];
        $product->offer_price=$data['offer_price'];
        $product->product_name=$data['product_name'];
        $product->slug = str_slug($data['product_name'],"-");
        $product->product_code=$data['product_code'];
        $product->product_brand=$data['product_brand'];
        $product->product_price=$data['product_price'];
        $product->short_description=$data['short_description'];
        $product->long_description=$data['description'];
        $product->status=$data['status'];
        $product->featured=$data['featured'];

    
      
        if ($request->hasFile('image')) {
            $img_tmp=$request->file('image');
            $extension=$img_tmp->getClientOriginalExtension();
            $filename=rand(111,99999).'.'.$extension;
         //   $img_path='public/Images/product/'.$filename;
            Image::make($img_tmp)->resize(540,720)->save(public_path('Images/Product/').$filename);
            $product->product_image=$filename;
           
        }
         $product->save();

         return redirect('products');
     }



     public function delete($id)
     {
        
          $productimage=Product::find($id);
          $image_path='Images/Product/';
         if(file_exists($image_path.$productimage->product_image))
         {
           unlink($image_path.$productimage->product_image);
         }
         $delete=Product::find($id);
         $delete->delete();
         return redirect('products');
     }

     public function updatestatus(Request $request,$id=null)
     {
      
         $data=$request->all();
         Product::where('id',$data['id'])->update(['status'=>$data['status']]);
     }

     public function featured(Request $request,$id=null)
     {

         $data=$request->all();
         Product::where('id',$data['id'])->update(['featured'=>$data['feature']]);
     }







     //----Add Images----------------

     public function addimage(Request $request,$id)
     {
    
        if($request->isMethod('post'))
        {
            $data=$request->all();
                   
            if ($request->hasFile('image')) {
                $files=$request->file('image');
                foreach($files as $file)
                {
                   $image=new ProductImage;
                   $extension=$file->getClientOriginalExtension();
                   $filename=rand(111,99999).'.'.$extension;
                //   $img_path='public/Images/product/'.$filename;
                   Image::make($file)->resize(540,720)->save(public_path('Images/product/').$filename);
                   $image->image=$filename;
                   $image->product_id=$data['product_id'];
                   $image->save();
                }
            
             
            }
            return redirect('add-images/'.$id);

        }

        $product_image=ProductImage::select('id','image')->where('product_id',$id)->get();
        $products=Product::with('brand')->select('id','product_name','product_price','product_code','product_image','product_brand')->where('id',$id)->first();
        return view('Backend.Product.addimages',compact('products','product_image'));
     }

     public function deleteimages($id)
     {
         $productimage=ProductImage::where('id',$id)->first();
         $image_path='Images/product/';
         if(file_exists($image_path.$productimage->image))
         {
             unlink($image_path.$productimage->image);
         }
         $delete=ProductImage::find($id);
         $delete->delete();
         return redirect()->back();
     }








       /////Add Attributes/////

    public function addcolor(Request $request,$id)
    {

  
        if($request->isMethod('post'))
        {
            $data=$request->all();
                   
            $color= new ProductColor;
            $color->product_id=$data['product_id'];
            $color->product_color=$data['color'];
            $color->save();
            return redirect('add-attributes/'.$id);

        }
     
    }






     public function addattributes(Request $request,$id)
     {
 
        if($request->isMethod('post'))
        {
            $data=$request->all();
            foreach($data['sku'] as $key=>$val)
            {
                if(!empty($val))
                {  //Prevent duplicate Sku
                    $attrCountSKU = ProductAttributes::where('sku',$val)->count();
                    if($attrCountSKU>0)
                    {
                        return redirect('add-attributes/'.$id)->with('flash_message_error','SKU is already exist Please select another');
                    }

                    //Prevent duplicate Size Record
                    // $attrCountSizes=ProductAttributes::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    // if($attrCountSizes>0)
                    // {
                    //  return redirect('add-attributes/'.$id)->with('flash_message_error',''.$data['size'][$key].'Size is already exist Please select another size');
                    // }

                    $attribute=new ProductAttributes;
                    $attribute->product_id=$id;
                    $attribute->color=$data['color'];
                    $attribute->sku=strtoupper($val);
                    $attribute->size=strtoupper($data['size'][$key]);
                    $attribute->price=$data['price'][$key];
                    $attribute->stock=$data['stock'][$key];

                    $attribute->save();
                }
            }
            return redirect('add-attributes/'.$id)->with('flash_message_success','Products attributes Added Successfully');
          
        }
    
        $product_attributes=ProductAttributes::with('product')->where('product_id',$id)->get();
        $products=Product::with('brand')->select('id','product_name','product_price','product_code','product_image','product_brand')->where('id',$id)->first();
        return view('Backend.Product.addattributes',compact('products','product_attributes'));
     }

     public function deleteattribute($id)
     {
         $delete=ProductAttributes::find($id);
         $delete->delete();
         return redirect()->back();
     }

     public function editattribute(Request $request,$id=null){

        dd($id);
      if($request->isMethod('post')){
          $data = $request->all();
      
          foreach($data['attr'] as $key=>$attr){
                ProductAttributes::where(['id'=>$data['attr'][$key]])->update(['color'=>$data['color'][$key],'sku'=>$data['sku'][$key],
              'size'=>$data['size'][$key],'price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
          }
          return redirect()->back()->with('flash_message_success','Products Attributes Updated!!!');
        }
       }


 
}
