<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        View::composer('partials._sideBar', function ($view) {
            // Fetch categories
            $categories = ProductCategory::whereNull('parent_id')->with('subcategories')->get();

            Log::info($categories);
            Log::info('View composer is executed');
            Log::info("categories:", ["categories" => $categories]);

            dd($categories);
            $view->with('categories', $categories);
        });
    }
}
