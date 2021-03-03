<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{
     public function index()
     {
         $category=category::all();
         return view('Backend.Category.Main.index',compact('category'));
     }

     public function store(Request $request)
     {
 
        $data=$request->all();
        $category=new category;
        $category->category=$data['category'];
        $category->slug = str_slug($data['category'],"-");
        $category->save();
    
        return redirect('main_category');
  
     }


     public function update(Request $request,$id)
     {

        $data=$request->all();
        $category=category::find($id);
        $category->category=$data['category'];
        $category->slug = str_slug($data['category'],"-");
        $category->save();

        return redirect('main_category');
     }

      
     public function updatestatus(Request $request,$id=null)
     {

        //  dd($request->all());
         $data=$request->all();
         category::where('id',$data['id'])->update(['status'=>$data['status']]);
     }


     public function delete($id)
     {
         $delete=category::find($id);
         $delete->delete();
         return redirect()->back();
     }



}
