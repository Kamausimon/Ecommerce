<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class AdminController extends Controller
{
    //
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.index', compact('products'));
    }
}
