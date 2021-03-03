<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\category;

class SubCategoryController extends Controller
{
    public function index()
    {
        $category=category::all();
        $sub_category=SubCategory::all();
        return view('Backend.Category.Sub.index',compact('category','sub_category'));
    }

    public function store(Request $request)
    {

       $data=$request->all();
       $category=new SubCategory;
       $category->sub_category=$data['sub_category'];
       $category->slug = str_slug($data['sub_category'],"-");
       $category->category_id=$data['category'];
       $category->save();

       return redirect('sub_category');
 
    }


    public function update(Request $request,$id)
    {

       $data=$request->all();
       $category=SubCategory::find($id);
       $category->category_id=$data['category'];
       $category->sub_category=$data['sub_category'];
       $category->slug = str_slug($data['sub_category'],"-");
       $category->save();

       return redirect('sub_category');
    }

     
    public function updatestatus(Request $request,$id=null)
    {

        $data=$request->all();
        SubCategory::where('id',$data['id'])->update(['status'=>$data['status']]);
    }


    public function delete($id)
    {
        $delete=SubCategory::find($id);
        $delete->delete();
        return redirect()->back();
    }


}
