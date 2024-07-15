<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 
    public function  login()
    {
        return view('Auth.login');
    }

    public function store(Request $request)
    {
        $request->merge([
            'email' => trim($request->email)
        ]);

        $request->validate([
          'name'=> 'required|max:255',
          'email'=> 'required|email|unique:users',
          'password'=>'required|min:8|confirmed',
          'mobile'=>
        ]);
    }

    public function Register()
    {
        return view('Auth.register');
    }

    public function RegisterUser()
    {
    }

    public function Logout()
    {
    }
}
