<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            'Electronics' => ['mobile phones', 'Laptops', 'Cameras', 'Televisions', 'Audio & Headphones', 'Accessories'],
            'Fashion' => ["men's clothing", "women's clothing", "kid's clothing", 'shoes', 'accessories', 'jewelry'],
            'Home & kitchen' => ['furniture', 'Home decor', 'Kitchen Appliances', 'cookware & tableware', 'bedding', 'storage & organization'],
            'Beauty & personal care' => ['skincare', 'haircare', 'makeup', 'fragnances'],
            'sports & outdoors' => ['exercise & fitness', 'outdoor recreation', 'team sports', ' camping & hiking', 'cyling'],
            'books & media' => ['books', 'ebooks', 'movies & TV shows', 'Music', 'video games ']
        ];

        foreach ($categories as $categoryName => $subcategories) {
            $category = ProductCategory::create(['name' => $categoryName, 'parent_id' => null]);

            foreach ($subcategories as $subcategoryName) {
                ProductCategory::create(['name' => $subcategoryName, 'parent_id' => $category->id]);
            }
        }
    }
}
