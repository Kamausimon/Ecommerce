<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\CartController;

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
Route::get('/product/{id}', [DashboardController::class, 'show'])->name('dashboard.show');
Route::get('/Products/search', [dashboardController::class, 'search'])->name('Products.search');


//product controller
Route::get('/createProduct', [ProductController::class, 'create'])->name('Products.create');
Route::post('/storeProduct', [ProductController::class, 'store'])->name('Products.store');
Route::get('/editProduct/{id}/edit', [ProductController::class, 'edit'])->name('Products.edit');
Route::post('/updateProduct/{id}', [ProductController::class, 'update'])->name('Products.update');
Route::post('/deleteProduct/{id}', [ProductController::class, 'delete'])->name('Products.delete');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
