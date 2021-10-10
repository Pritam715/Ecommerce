<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    public function index()
    {   $advertisement=Advertisement::select('id','image','status')->orderBy('id','desc')->get();
        return view('Backend.Advertisment.index',compact('advertisement'));
    }



    public function store(Request $request)
    {
   
      
           $data=$request->all();
                  
           if ($request->hasFile('image')) {
               $files=$request->file('image');
               foreach($files as $file)
               {
                  $image=new Advertisement;
                  $extension=$file->getClientOriginalExtension();
                  $filename=rand(111,99999).'.'.$extension;
               //   $img_path='public/Images/product/'.$filename;
                  Image::make($file)->resize(540,720)->save(public_path('Images/Advertisement/').$filename);
                  $image->image=$filename;
                  $image->save();
               }
           
            
           }

            return redirect()->back();
    
    }

    public function updatestatus(Request $request,$id=null)
    {
     
        $data=$request->all();
        Advertisement::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    public function delete($id)
    {
       
         $advertisement=Advertisement::find($id);
         $image_path='Images/Advertisement/';
        if(file_exists($image_path.$advertisement->image))
        {
          unlink($image_path.$advertisement->image);
        }
        $delete=Advertisement::find($id);
        $delete->delete();
        return redirect()->back();
    }

}
