<?php

namespace App\Http\Controllers;

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
