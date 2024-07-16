<?php

namespace App\Http\Controllers;

use GuzzleHttp\Promise\Create;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    // 
    public function  login()
    {
        return view('Auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('dashboard.index');
        }

        return back()->withErrors([
            'login' => 'one of the fields is incorrect'
        ]);
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
            'Mobile' => 'required|digits_between:10,15|unique:users'
        ]);

        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'Mobile' => $request->Mobile
        ]);

        Auth::login($user);

        return redirect()->route('Auth.login')->with('Success', 'user registered successfully');
    }
}
