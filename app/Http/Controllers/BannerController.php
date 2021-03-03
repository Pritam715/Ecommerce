<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Image;
use App\Models\category;

class BannerController extends Controller
{
     
    public function index()
    {
        $category=category::all();
        $banner=Banner::all();
        return view('Backend.Banner.index',compact('banner','category'));
    }



    public function store(Request $request)
    {
        $data=$request->all();

        $banner= new Banner;
        $banner->category_id=$data['category_id'];
        $banner->title=$data['title'];
        $banner->slug = str_slug($data['title'],"-");
        $banner->offer_id=$data['offer_id'];
        $banner->description=$data['description'];
        $banner->link=$data['link'];



    
      
        if ($request->hasFile('image')) {
            $img_tmp=$request->file('image');
            $extension=$img_tmp->getClientOriginalExtension();
            $filename=rand(111,99999).'.'.$extension;
         //   $img_path='public/Images/product/'.$filename;
            Image::make($img_tmp)->resize(1920,700)->save(public_path('Images/Banner/').$filename);
            $banner->banner_image=$filename;
           
        }
         $banner->save();

         return redirect('banners');
    }


    
    public function updatestatus(Request $request,$id=null)
    {

       //  dd($request->all());
        $data=$request->all();
        Banner::where('id',$data['id'])->update(['status'=>$data['status']]);
    }



    public function update(Request $request,$id)
    {
        $data=$request->all();

        $banner=Banner::find($id);
        $banner->category_id=$data['category_id'];
        $banner->title=$data['title'];
        $banner->slug = str_slug($data['title'],"-");

        if($data['offer_id'])
        {
            $banner->offer_id=$data['offer_id'];
        }

        if($data['link'])
        {
            $banner->link=$data['link'];
        }

        $banner->description=$data['description'];



    
      
        if ($request->hasFile('image')) {
            $img_tmp=$request->file('image');
            $extension=$img_tmp->getClientOriginalExtension();
            $filename=rand(111,99999).'.'.$extension;
         //   $img_path='public/Images/product/'.$filename;
            Image::make($img_tmp)->resize(1920,700)->save(public_path('Images/Banner/').$filename);
            $banner->banner_image=$filename;
           
        }
         $banner->save();

         return redirect('banners');
    }




    public function delete($id)
    {
          
        $bannerimage=Banner::find($id);
        $image_path='Images/Banner/';
       if(file_exists($image_path.$bannerimage->banner_image))
       {
         unlink($image_path.$bannerimage->banner_image);
       }
       $delete=Banner::find($id);
       $delete->delete();
       return redirect('banners');
    }
}
