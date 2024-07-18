<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        //showcase all the various products
        $products = Product::paginate(15);
        return view('dashboard.index', compact('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //    
        $product = Product::findOrFail($id);
        Log::info("product retrieved");

        return view('dashboard.show', ['product' => $product]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::query();

        if ($query) {
            $products = $products->where('name', 'like', "%{$query}%")->orWhere('category', 'like', "%{$query}%");
        }

        $products = $products->paginate(15);

        if (auth()->check()) {
            return view('dashboard.index', ['products' => $products]);
        } else {
            return view('landing.index', ['products' => $products]);
        }
    }
}
