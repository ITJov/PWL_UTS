<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sesiController extends Controller
{
   function index(){
        return view('login');
   }
   function login(Request $request){
       $request->validate([
          'name'=>'required',
           'password'=>'required'
       ],[
           'name.required' => 'Username belum diisi',
           'password.required' => 'Password belum diisi',
       ]);

       $infologin=[
           'name'=>$request->name,
            'password'=>$request->password,
       ];

       if(Auth::attempt($infologin)){
            if(Auth::user()->role =='1'){
                return redirect('admin/operator');
            }
            else if(Auth::user()->role =='2'){
                return redirect('admin/user');
            }
       }else{
            return redirect('')->withErrors('Username dan password yang dimasukan salah')->withInput();
       };
   }
   function logout(){
       Auth::logout();
       return redirect('login');
   }
}
