<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // public function login(Request $request)
    // {
    //     if($request->isMethod('post')){
    //         $data = $request->input();
    //         if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password'], 'level' == '1']))
    //         {
    //             return redirect( route('admin.home'));
    //         }else
    //         {
    //             return redirect( route('admin.login'));
    //         }
    //     }
    //     return view('admin.auth.login');
    // }

    public function logout(){
        Session::flush();
        return redirect( route('login'));
    }

    public function dashboard(){
        return view('admin.home');
    }
}
