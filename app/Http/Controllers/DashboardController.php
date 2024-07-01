<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        //showcase all the various products
        $products = Product::paginate(20);
        return view('dashboard.index', ['products' => $products]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //    
        $product = Product::findOrFail($id);
        return view('dashboard.show', ['product' => $product]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Product::where('name', 'like', "%{$query}%")->orWhere('categiry', 'like', "%{$query}%")->paginate(15);


        return view('profile.dashboard', ['posts' => $posts]);
    }
}
