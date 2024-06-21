<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductInventory;



class ProductController extends Controller
{
    public function debug_to_console($data)
    {
        $output = $data;

        if (is_array($output)) $output = implode(",", $output);

        echo "<script>console.log('Debug Objects: " . $output . "') </script>";
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = ProductCategory::WhereNull('parent_id')->with('subCategories')->get();
        return view('Products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */



    public function store(Request $request)
    {
        // Validate the data including the image
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Updated validation rule for image
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:product_category,id',
            'inventory_id' => 'required|exists:product_inventory,id',
            'discount_id' => 'nullable|exists:discount,id'
        ]);

        Log::channel('product_log')->info('Validation passed, proceeding to create product.', ['data' => $validatedData]);
        debug_to_console($validatedData);

        try {
            // Create the product
            $product = new Product;
            $product->name = $validatedData['name'];

            // Generate a unique SKU
            do {
                $sku = 'SKU-' . time() . '-' . rand(1000, 9999);
            } while (Product::where('SKU', $sku)->exists());

            Log::channel('product_log')->info('SKU generated: ' . $sku, ['data' => $sku]);
            debug_to_console($sku);

            // Handle the image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('images', $imageName, 'public');
                $product->image_path = $imagePath; // Save the path of the image
            }

            $inventoryId = $request->input('inventory_id');
            if (!$inventoryId) {
                $inventory = new ProductInventory();
                $inventory->quantity = 0;
                $inventory->location = 'Default Location';
                $inventory->save();
                $defaultInventoryId = $inventory->id;
            }

            Log::channel('product_log')->info('Inventory id created successfully' . $inventory->id, ['data' => $inventory->id]);
            debug_to_console($inventory->id);

            $product->description = $validatedData['description'];
            $product->SKU = $sku;
            $product->price = $validatedData['price'];
            $product->category_id = $validatedData['category_id'];
            $product->inventory_id = $inventoryId ?? $defaultInventoryId;
            $product->discount_id = $validatedData['discount_id'];

            // Save the product
            $product->save();
            Log::channel('product_log')->info('Product saved successfully: ' . $product->id, ['data' => $product]);

            // Debugging output
            debug_to_console($product);

            // Redirect the user to see the created product
            // return redirect()->route('dashboard.show', ['product' => $product->id])
            //     ->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            Log::error('Error creating the product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create product. Try again.']);
        }
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::findOrFail($id);
        if (!$product) {
            abort(404);
        }
        return view('Products.edit');
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image_path' => 'nullable|url',
            'description' => 'required|max:1000',
            'SKU' => 'required',
            'price' => 'required'
        ]);

        try {
            $product = Product::findOrFail($id);
            $product->update($validatedData);

            // Optionally, redirect to a page (e.g., product details) with a success message
            return redirect()->route('products.show', $product->id)->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            // Log the error and redirect back with an error message
            Log::error('Error updating product: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update product.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()->route('dashboard.index')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            Log::error('error deleting the product' . $e->getMessage());
            return back()->withErrors(['error' => 'failed to delete product'])->withInput();
        }
    }

    public function showCategories()
    {
        $categories = ProductCategory::WhereNull('parent_id')->with('subCategories')->get();

        return view('categories.index', compact('categories'));
    }
}
