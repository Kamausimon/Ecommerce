<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//dashboard controller
Route::get('/products', [DashboardController::class, 'index'])->name('dashboard.index'); //displays all the created products
Route::get('/product/{id}', [DashboardController::class, 'show'])->name('dashboard.show');

//product controller
Route::get('/createProduct', [ProductController::class, 'create'])->name('Products.create');
Route::post('/storeProduct', [ProductController::class, 'store']);
Route::get('/editProduct/{id}/edit', [ProductController::class, 'edit'])->name('Products.edit');
Route::post('/updateProduct/{id}', [ProductController::class, 'update'])->name('Products.update');
Route::post('/deleteProduct/{id}', [ProductController::class, 'delete'])->name('Products.delete');

require __DIR__ . '/auth.php';
