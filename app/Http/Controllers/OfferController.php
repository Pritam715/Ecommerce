<?php

namespace App\Http\Controllers;
use Image;
use App\Models\Offer;

use Illuminate\Http\Request;

class OfferController extends Controller
{
    
    public function index()
    {
        $offers=Offer::all();
        return view('Backend.Offer.index',compact('offers'));
    }

    
    public function store(Request $request)
    {
       $data=$request->all();
       
       $offer=new Offer;
       $offer->title=$data['title'];
       $offer->offer=$data['offer'];
       $offer->slug = str_slug($data['title'],"-");
       if($request->hasFile('image')) {
           $img_tmp=$request->file('image');
           $extension=$img_tmp->getClientOriginalExtension();
           $filename=rand(111,99999).'.'.$extension;
           //$img_path='public/Images/product/'.$filename;
          Image::make($img_tmp)->resize(500,540)->save(public_path('Images/Offer/').$filename);
          $offer->image=$filename;
      
          
       }
       $offer->save();
       return redirect()->back();

    }

       
    public function update(Request $request,$id)
    {

       $data=$request->all();
       
       $offer=Offer::find($id);
       $offer->title=$data['title'];
      
       $offer->slug = str_slug($data['title'],"-");
       $offer->offer=$data['offer'];
       if($request->hasFile('image')) {
           $img_tmp=$request->file('image');
           $extension=$img_tmp->getClientOriginalExtension();
           $filename=rand(111,99999).'.'.$extension;
           //$img_path='public/Images/product/'.$filename;
          Image::make($img_tmp)->resize(500,450)->save(public_path('Images/Offer/').$filename);
          $offer->image=$filename;
      
          
       }
       $offer->save();
       return redirect()->back();

    }


    public function updatestatus(Request $request,$id=null)
    {

       //  dd($request->all());
        $data=$request->all();
        Offer::where('id',$data['id'])->update(['status'=>$data['status']]);
    }



}
