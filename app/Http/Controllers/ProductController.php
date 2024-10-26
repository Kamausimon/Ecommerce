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
        // Validate the data including the stock
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:1000',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:product_category,id',
            'stock' => 'required|integer|min:0',
        ]);

        Log::info('Validation passed, proceeding to create product.', ['data' => $validatedData]);

        try {
            // Start a transaction
            DB::beginTransaction();

            // Create the product instance
            $product = new Product;

            // Handle inventory ID
            $inventoryId = $request->input('inventory_id');
            if (!$inventoryId) {
                $inventory = new ProductInventory();
                $inventory->quantity = 0;
                $inventory->location = 'Default Location';
                $inventory->status = 'in stock';
                $inventory->save();
                $inventoryId = $inventory->id;
            }
            Log::info('Inventory created successfully', ['id' => $inventoryId]);

            // Handle discount
            $discountId = $request->input('discount_id');  // Corrected typo here
            if (!$discountId) {
                $discount = new Discount();
                $discount->discount_percentage = 0;
                $discount->name = 'No Discount';
                $discount->description = 'No Discount';
                $discount->status = 0;
                $discount->save();
                $discountId = $discount->id;
            }
            Log::info('Discount created successfully', ['id' => $discountId]);

            // Generate a unique SKU
            do {
                $sku = 'SKU-' . time() . '-' . rand(1000, 9999);
            } while (Product::where('SKU', $sku)->exists());
            Log::info('SKU generated successfully', ['sku' => $sku]);

            // Handle the image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('public/images', $imageName);

                Log::info('Image uploaded successfully', ['path' => $imagePath]);

                $product->image_path = str_replace('public/', '', $imagePath); // Save the path of the image
            }

            // Set other product attributes
            $product->name = $validatedData['name'];
            $product->description = $validatedData['description'];
            $product->SKU = $sku;
            $product->price = $validatedData['price'];
            $product->category_id = $validatedData['category_id'];
            $product->inventory_id = $inventoryId;
            $product->discount_id = $discountId;
            $product->stock = $validatedData['stock'];

            // Log the product data before saving to confirm everything is set correctly
            Log::info('Product attributes before saving:', [
                'name' => $product->name,
                'description' => $product->description,
                'SKU' => $product->SKU,
                'price' => $product->price,
                'category_id' => $product->category_id,
                'inventory_id' => $product->inventory_id,
                'discount_id' => $product->discount_id,
                'stock' => $product->stock
            ]);

            // Save the product
            $product->save();
            Log::info('Product saved successfully: ' . $product->id, ['data' => $product]);

            // Commit the transaction
            DB::commit();

            // Redirect the user to see the created product
            return redirect()->route('Products.show', ['id' => $product->id])
                ->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

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
        return view('Products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required',
            'image_path' => 'nullable|url',
            'description' => 'required|max:1000',
            'stock' => 'required|integer',
            'price' => 'required',
            'category_id' => 'required|exists:product_category,id'
        ]);

        Log::info('Validation passed, proceeding to update product.', ['data' => $validatedData]);

        try {
            // Find the product
            $product = Product::findOrFail($id);

            // Log current data
            Log::info('Existing Product Data', ['product' => $product]);

            // Update the product attributes
            $product->name = $validatedData['name'];
            $product->description = $validatedData['description'];
            $product->stock = $validatedData['stock'];
            $product->price = $validatedData['price'];
            $product->category_id = $validatedData['category_id'];

            // Preserve fields that are not in the validated data
            $product->SKU = $product->SKU;  // SKU should remain unchanged
            $product->inventory_id = $product->inventory_id;  // Inventory ID should remain unchanged
            $product->discount_id = $product->discount_id;  // Discount ID should remain unchanged

            // Save the updated product
            $product->save();

            Log::info('Product updated successfully: ' . $product->id, ['data' => $product]);

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
            return redirect()->route('Admin.index')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            Log::error('error deleting the product' . $e->getMessage());
            return back()->withErrors(['error' => 'failed to delete product'])->withInput();
        }
    }
}
