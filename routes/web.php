<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogoutController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\Logout;

//profileController
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
Route::get('/products/subcategory/{subcategoryId}', [ProductController::class, 'showProductsBySubcategory']); //displays products by subcategory

//cart controller
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [cartController::class, 'add'])->name('cart.add');

//landingPageController
Route::get('/landing', [LandingPageController::class, 'index'])->name('landing.index');

//UserController
Route::get('/login', [UserController::class, 'login'])->name('Auth.login');
Route::post('/login', [UserController::class, 'store']);

//registerController
Route::get('/register', [RegisterController::class, 'Register'])->name('Auth.register');
Route::post('registerUser', [RegisterController::class, 'RegisterUser']);

//logoutcontroller
Route::post('/logoutUser', [LogoutController::class, 'destroy'])->name('Auth.logout');
