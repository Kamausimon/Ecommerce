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

        $keyword = $request->input('search');
        Log::info("Search query: " . $keyword);

        // Search for products by name only
        $products = Product::where('name', 'like', '%' . $keyword . '%')->orWhere('category', 'like', '%' . $keyword . '%')->get();

        // Ensure the correct view is being returned
        return view('dashboard.index', ['products' => $products]);
    }
}
