<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory as Category;

class CategoryController extends Controller
{
    //
    public function show()
    {
        $categories = Category::all();
        return view('_sideBar')->with('categories', $categories);
    }
}
