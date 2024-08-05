<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductInventory;
use illuminate\support\facades\DB;
use App\Models\Discount;



class ProductController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = ProductCategory::WhereNull('parent_id')->with('subCategories')->get(); // Get all the categories
        return view('Products.create', compact('categories')); // Return the view with the categories
    }

    /**
     * Store a newly created resource in storage.
     */



    public function store(Request $request)
    {



        // Validate the data including the image
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:1000',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:product_category,id'
        ]);

        Log::info('Validation passed, proceeding to create product.', ['data' => $validatedData]);


        try {
            // Start a transaction
            DB::beginTransaction();

            // Create the product
            $product = new Product;
            $product->name = $validatedData['name'];

            // Handle inventory ID
            $inventoryId = $request->input('inventory_id');
            if (!$inventoryId) {
                $inventory = new ProductInventory();
                $inventory->quantity = 0;
                $inventory->location = 'Default Location';
                $inventory->status = 'in stock';
                $inventory->save();
                $inventoryId = $inventory->id;
                Log::info('Inventory id created successfully: ' . $inventoryId, ['data' => $inventoryId]);
            }

            //handle discount
            $discountId = $request->input('dicount_id');
            if (!$discountId) {
                $discount = new Discount();
                $discount->discount_percentage = 0;
                $discount->name = 'No Discount';
                $discount->description = 'No Discount';
                $discount->status = 0;
                $discount->save();
                $discountId = $discount->id;
                Log::info('Discount id created successfully: ' . $discountId, ['data' => $discountId]);
            }

            // Generate a unique SKU
            do {
                $sku = 'SKU-' . time() . '-' . rand(1000, 9999);
            } while (Product::where('SKU', $sku)->exists());

            Log::info('SKU generated: ' . $sku, ['data' => $sku]);


            // Handle the image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('public/images', $imageName);

                Log::info('Image uploaded successfully', ['path' => $imagePath]);

                $product->image_path = str_replace('public/', '', $imagePath); // Save the path of the image
            }



            Log::info('Inventory id created successfully: ' . $inventoryId, ['data' => $inventoryId]);

            $product->name = $validatedData['name'];
            $product->description = $validatedData['description'];
            $product->SKU = $sku;
            $product->price = $validatedData['price'];
            $product->category_id = $validatedData['category_id'];
            $product->inventory_id = $inventoryId;
            $product->discount_id = $validatedData['discount_id'] ?? null;

            // Save the product
            $product->save();
            Log::info('Product saved successfully: ' . $product->id, ['data' => $product]);

            // Commit the transaction
            DB::commit();



            //Redirect the user to see the created product
            return redirect()->route('Products.show', ['id' => $product->id])
                ->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            Log::error('Error creating the product: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create product. Try again.']);
        }
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        Log::info("product retrieved");



        return view('Products.show', compact('product',));
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
        return view('Products.edit', compact('product'));
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
            return redirect()->route('Products.show', $product->id)->with('success', 'Product updated successfully.');
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
            return redirect()->route('admin.index')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            Log::error('error deleting the product' . $e->getMessage());
            return back()->withErrors(['error' => 'failed to delete product'])->withInput();
        }
    }
}
