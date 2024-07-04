<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    //
    public function show()
    {
        $categories = ProductCategory::WhereNull('parent_id')->with('subCategories')->get();
        return view('partials._sidebar', compact('categories'));
    }
}
