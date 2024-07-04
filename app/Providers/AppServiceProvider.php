<?php

namespace App\Providers;

use App\Models\ProductCategory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('partials._sideBar', function ($view) {
            //fetch categories 
            $categories = ProductCategory::whereNull('parent_id')->with('subcategories')->get();
            $view->with('categories', $categories);
        });
    }
}
