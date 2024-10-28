<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LandingPageController extends Controller
{
    //
    public function index()
    {
        $products = Product::paginate(20);
        return view('User.welcome', ['products' => $products]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query'); // Capture the 'query' parameter from the request

        // Log the search term for debugging
        Log::info("Search Term: " . $query);

        // Enable query log
        DB::enableQueryLog();

        // Build the query
        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })->paginate(15);

        // Get the query log
        $queryLog = DB::getQueryLog();
        Log::info("SQL Query Log: ", $queryLog);

        // Return the view with the products
        return view('User.welcome', ['products' => $products]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        Log::info("product retrieved");

        return view('Landing.show', ['product' => $product]);
    }
}
