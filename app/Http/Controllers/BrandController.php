<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
     public function index()
     {
         $brand=Brand::all();
         return view('Backend.Brand.index',compact('brand'));
     }

     
     public function store(Request $request)
     {
        $data=$request->all();
        
        $brand=new Brand;
        $brand->brand_name=$data['brand_name'];
        $brand->slug = str_slug($data['brand_name'],"-");
        if($request->hasFile('image')) {
            $img_tmp=$request->file('image');
            $extension=$img_tmp->getClientOriginalExtension();
            $filename=rand(111,99999).'.'.$extension;
            //$img_path='public/Images/product/'.$filename;
           Image::make($img_tmp)->resize(135,33)->save(public_path('Images/Brand/').$filename);
           $brand->brand_image=$filename;
       
           
        }
        $brand->save();
        return redirect('brand');

     }

     
     
     public function update(Request $request,$id)
     {

        $data=$request->all();
        
        $brand=Brand::find($id);
        $brand->brand_name=$data['brand_name'];
        $brand->slug = str_slug($data['brand_name'],"-");
        if($request->hasFile('image')) {
            $img_tmp=$request->file('image');
            $extension=$img_tmp->getClientOriginalExtension();
            $filename=rand(111,99999).'.'.$extension;
            //$img_path='public/Images/product/'.$filename;
           Image::make($img_tmp)->resize(135,33)->save(public_path('Images/Brand/').$filename);
           $brand->brand_image=$filename;
       
           
        }
        $brand->save();
        return redirect('brand');

     }

     public function updatestatus(Request $request,$id=null)
     {

        //  dd($request->all());
         $data=$request->all();
         Brand::where('id',$data['id'])->update(['status'=>$data['status']]);
     }


     
     public function delete($id)
     {
          $brandimage=Brand::where('id',$id)->first();
          $image_path='Images/Brand/';
         if(file_exists($image_path.$brandimage->brand_image))
         {
           unlink($image_path.$brandimage->brand_image);
         }
         $delete=Brand::find($id);
         $delete->delete();
         return redirect('brand');
     }




}
