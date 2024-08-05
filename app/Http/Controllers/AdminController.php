<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use illuminate\Support\Facades\Auth;



class AdminController extends Controller
{
    //
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.index', compact('products'));
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('User.welcome')->with('success logging you out');
    }
}
