<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    //
    public function index()
    {
        $Products = Product::paginate(20);
        return view('admin.index', compact('Products'));
    }
}
