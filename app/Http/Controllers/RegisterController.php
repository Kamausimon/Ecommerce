<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
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
            'mobile' => $request->mobile
        ]);

        Auth::login($user);

        return redirect()->route('Auth.login')->with('Success', 'user registered successfully');
    }
}
