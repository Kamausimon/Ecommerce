<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LoginController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;



//profileController
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.index');


//dashboard controller
Route::middleware(['auth'])->group(function () {
    Route::get('/products', [DashboardController::class, 'index'])->name('dashboard.index'); //displays all the created products
    Route::get('/product/{id}', [DashboardController::class, 'show'])->name('dashboard.show'); //displays a single product
    Route::get('Product/search', [DashboardController::class, 'search'])->name('Product.search'); //search for a product
    Route::get('/product/subcategory/{id}', [DashboardController::class, 'sidebarSearch'])->name('sidebar.search');
});


//product controller
Route::middleware(['auth'])->group(function () {
    Route::get('/createProduct', [ProductController::class, 'create'])->name('Products.create'); //displays the form to create a product
    Route::post('/storeProduct', [ProductController::class, 'store'])->name('Products.store'); //stores the product
    Route::get('/editProduct/{id}/edit', [ProductController::class, 'edit'])->name('Products.edit'); //displays the form to edit a product
    Route::post('/updateProduct/{id}', [ProductController::class, 'update'])->name('Products.update'); //updates the product
    Route::post('/deleteProduct/{id}', [ProductController::class, 'delete'])->name('Products.delete'); //deletes the product
    Route::get('/products/subcategory/{subcategoryId}', [ProductController::class, 'showProductsBySubcategory']); //displays products by subcategory
});


//cart controller
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [cartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [cartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{id}', [cartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{id}', [cartController::class, 'update'])->name('cart.update');
    Route::post('/cart/clear', [cartController::class, 'clear'])->name('cart.clear');
});


//landingPageController
Route::get('/', [LandingPageController::class, 'index'])->name('User.welcome');
Route::get('/landing/{id}', [LandingPageController::class, 'show'])->name('landing.show');
Route::get('/search', [LandingPageController::class, 'search']);


//LoginController
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('Auth.login');
Route::post('/login', [LoginController::class, 'login'])->name('Auth.loginUser');

//registerController
Route::get('/register', [RegisterController::class, 'Register'])->name('Auth.register');
Route::post('registerUser', [RegisterController::class, 'RegisterUser']);

//logoutcontroller
Route::post('/logoutUser', [LogoutController::class, 'destroy'])->name('Auth.logout')->middleware('auth');
