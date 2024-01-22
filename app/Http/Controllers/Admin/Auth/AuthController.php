<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(){
        return  view('admin.login');
    }

    public function authenticate(Request $request){
        Auth::guard('admin')->attempt(['email'=>$request->email, 'password' => $request->password]);

        return view('admin.dashboard');
    }
}