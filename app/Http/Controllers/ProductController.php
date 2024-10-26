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

    public function show(string $id)
    {
        //
        $product = Product::findOrFail($id);
        if (!$product) {
            abort(404);
        }
        return view('Products.show', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     * /** */


    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'description' => 'required|max:1000',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:product_category,id',
                'stock' => 'required|integer|min:0',

            ]);
            Log::info('Validation passed, proceeding to update product.', ['data' => $request->all()]);

            $product = Product::findOrFail($id);
            if (!$product) {
                abort(404);
            }

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($product->image_path && Storage::exists('public/' . $product->image_path)) {
                    Storage::delete('public/' . $product->image_path);
                }

                // Save new image
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('public/images', $imageName);
                $product->image_path = str_replace('public/', '', $imagePath); // Store new path
            }
            Log::info('Product found', ['product' => $product]);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->stock = $request->stock;
            $product->save();
            Log::info('Product updated successfully', ['product' => $product]);

            return redirect()->route('Products.show', ['id' => $product->id])
                ->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating product:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error updating product', 'error' => $e->getMessage()], 500);
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
