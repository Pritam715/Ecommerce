<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\SubCategory;
use App\Models\Subsubcategory;

class SubsubcategoryController extends Controller
{
    
    public function index()
    {
        $sub_subcategory=Subsubcategory::with('category')->with('subcategory')->get();
        $category=category::all();
        return view('Backend.Category.Sub_sub.index',compact('category','sub_subcategory'));
    }
    
    public function findSubcategory(Request $request){

     $data=SubCategory::select('sub_category','id')->where('category_id',$request->id)->get();
     return response()->json($data);//then sent this data to ajax success
    }
      
    public function findSubsubcategory(Request $request){

        $data=Subsubcategory::select('sub_subcategory','id')->where('sub_category_id',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
       }
   
   







    public function store(Request $request)
    {

       $data=$request->all();
       $category=new Subsubcategory;
       $category->sub_subcategory=$data['sub_subcategory'];
       $category->slug = str_slug($data['sub_subcategory'],"-");
       $category->sub_category_id=$data['sub_category_id'];
       $category->category_id=$data['category_id'];
       $category->save();

       return redirect('sub_subcategory');
 
    }


    public function update(Request $request,$id)
    {
 

       $data=$request->all();
       $category=Subsubcategory::find($id);
       $category->sub_subcategory=$data['sub_subcategory'];
       $category->slug = str_slug($data['sub_subcategory'],"-");
       $category->sub_category_id=$data['sub_category_id'];
       $category->category_id=$data['category_id'];
       $category->save();


       return redirect('sub_subcategory');
    }

     
    public function updatestatus(Request $request,$id=null)
    {

        $data=$request->all();
        Subsubcategory::where('id',$data['id'])->update(['status'=>$data['status']]);
    }


    public function delete($id)
    {
        $delete=Subsubcategory::find($id);
        $delete->delete();
        return redirect()->back();
    }


}
