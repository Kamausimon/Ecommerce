<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.index');


//dashboard controller
Route::get('/products', [DashboardController::class, 'index'])->name('dashboard.index'); //displays all the created products
Route::get('/product/{id}', [DashboardController::class, 'show'])->name('dashboard.show'); //displays a single product
Route::get('/Products/search', [dashboardController::class, 'search'])->name('Products.search'); //search for a product


//product controller

Route::get('/createProduct', [ProductController::class, 'create'])->name('Products.create'); //displays the form to create a product
Route::post('/storeProduct', [ProductController::class, 'store'])->name('Products.store'); //stores the product
Route::get('/editProduct/{id}/edit', [ProductController::class, 'edit'])->name('Products.edit'); //displays the form to edit a product
Route::post('/updateProduct/{id}', [ProductController::class, 'update'])->name('Products.update'); //updates the product
Route::post('/deleteProduct/{id}', [ProductController::class, 'delete'])->name('Products.delete'); //deletes the product

//cart controller
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/products-by-subcategory/{subcategoryId}', [ProductController::class, 'getProductsBySubcategory']);
