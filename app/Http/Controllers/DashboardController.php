<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
        return view('dashboard.index', ['products' => $products]);
    }

    public function sidebarSearch(Request $request)
    {
        $subCategoryId = $request->id;



        DB::enableQueryLog();

        $products = Product::whereHas('category', function ($query) use ($subCategoryId) {
            // Here we check if the product's category is a subcategory with the given ID
            // or if the product's category has a parent category with the given ID
            $query->where('id', $subCategoryId)
                ->orWhereHas('parentCategory', function ($parentQuery) use ($subCategoryId) {
                    $parentQuery->where('id', $subCategoryId);
                });
        })->paginate(15);

        $queryLog = DB::getQueryLog();
        Log::info("SQL Query Log:", ['queryLog' => $queryLog]);

        return view('dashboard.index', ['products' => $products]);
    }
}
