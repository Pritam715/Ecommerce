<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Session;
use Auth;

class CustomerController extends Controller
{
    public function account(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();

         //    echo "<pre>";print_r($data);die;
         if(Customer::where(['email'=>$data['email'],'password'=>$data['password']])->count() == 1){
             Session::put('frontSession',$data['email']);
             return redirect('/');
         }else{
             return redirect()->back()->with('flash_message_error','Invalid username and password!');
         }
        }


        return view('Frontend.Login.index');
    }



          
    public function logout()
    {
        Session::forget('frontSession');
        return redirect('/');
    }



}
