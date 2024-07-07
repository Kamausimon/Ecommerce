<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProductCategory;

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
            $view->with('categories', $categories);
        });
    }
}
