<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function login(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if($v->fails()){
            return back()->with('error', 'Email or Password Wrong');
        }
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect(route('admin.index'));
        }else{
            return back()->with('error', 'Email or Password Wrong');
        }
    }
    function logout(){
        Auth::logout();
        return redirect(route('admin.loginView'));
    }
}
