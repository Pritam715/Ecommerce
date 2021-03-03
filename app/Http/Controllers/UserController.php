<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Hash;
use Image;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $roles=Role::all();
         $user=User::all();
         return view('Backend.User.index',compact('user','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        $data=$request->all();

        $user= new User;
        $user->name=$data['username'];
        $user->email=$data['email'];
        $user->password=Hash::make($data['password']);
        $user->address=$data['address'];
        $user->mobile_no = $data['number'];


        $user->assignRole($data['role_id']);
     
        if ($request->hasFile('image')) {
            $img_tmp=$request->file('image');
            $extension=$img_tmp->getClientOriginalExtension();
            $filename=rand(111,99999).'.'.$extension;
         //   $img_path='public/Images/user/'.$filename;
            Image::make($img_tmp)->resize(250,300)->save(public_path('Images/User/').$filename);
            $user->image=$filename;
           
        }
         $user->save();

         return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

         //dd($request->all());
        $data=$request->all();

        $user= User::find($id);
        $user->name=$data['username'];
        $user->email=$data['email'];
        if($data['password'])
        {
            $user->password=Hash::make($data['password']);
        }
    
        $user->address=$data['address'];
        $user->mobile_no = $data['number'];
        if($data['role_id'])
        {
            $user->assignRole($data['role_id']);
        }

    
            if ($request->hasFile('image')) {
                $img_tmp=$request->file('image');
                $extension=$img_tmp->getClientOriginalExtension();
                $filename=rand(111,99999).'.'.$extension;
             //   $img_path='public/Images/user/'.$filename;
                Image::make($img_tmp)->resize(250,300)->save(public_path('Images/User/').$filename);
                $user->image=$filename;
               
            }
        
 
         $user->save();

         return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
