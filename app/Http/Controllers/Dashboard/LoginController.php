<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){

        return view('admin.dashboard.login');
    }

    public function checkLogin(LoginRequest  $request){
        //return $request;
        $remember_me = $request->has('remember_me') ? true :false ;
        if (auth()->
        guard('admin')->
        attempt(['email'=> $request->input('email'),
                  'password'=>$request->input('password')])){
            return redirect()->route('admin.dashboard');
        }

        //dd('not founded');
        return redirect()->back()->with(['error'=>'هناك خطأ بالبيانات']);
        //dd('..........');
    }
}
