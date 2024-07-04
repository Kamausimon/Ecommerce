<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    //
    // public function show()
    // {
    //     // Check if the method is being called
    //     Log::info('CategoryController@show method called.');

    //     // Fetch categories
    //     $categories = ProductCategory::whereNull('parent_id')->with('subcategories')->get();

    //     // Log the retrieved categories
    //     Log::info('Categories retrieved:', ['categories' => $categories]);

    //     // Dump and die the categories
    //     dd($categories);

    //     return view('partials._sideBar', compact('categories'));
    // }
}
