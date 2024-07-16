<?php

namespace App\Http\Controllers;

use GuzzleHttp\Promise\Create;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function RegisterUser(Request $request)
    {
        $request->merge([
            'email' => trim($request->email)
        ]);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'mobile' => 'required|digits_between:10,15|unique:users'
        ]);

        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
    }

    public function Logout()
    {
    }
}
