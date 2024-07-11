<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class LandingPageController extends Controller
{
    //
    public function index()
    {
        $products = Product::paginate(20);
        return view('User.welcome', ['products' => $products]);
    }
}
