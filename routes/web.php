<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\MpesaController;


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;



// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.index');
    Route::get('/editProfile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/updateProfile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/deleteProfile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Password Routes
    Route::get('/profile/password', [ProfileController::class, 'showPasswordForm'])->name('profile.passwordForm');
    Route::post('/profile/password', [ProfileController::class, 'password'])->name('profile.passwordUpdate');
});



//dashboard controller
Route::middleware(['auth'])->group(function () {
    Route::get('/products', [DashboardController::class, 'index'])->name('dashboard.index'); //displays all the created products
    Route::get('/product/{id}', [DashboardController::class, 'show'])->name('dashboard.show'); //displays a single product
    Route::get('Product/search', [DashboardController::class, 'search'])->name('Product.search'); //search for a product
    Route::get('/product/subcategory/{id}', [DashboardController::class, 'sidebarSearch'])->name('sidebar.search'); // sidebar search
});


//product controller
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('Admin.index');
    Route::post('/logoutAdmin', [AdminController::class, 'destroy'])->name('Admin.logout');
    Route::get('/createProduct', [ProductController::class, 'create'])->name('Products.create'); //displays the form to create a product
    Route::post('/storeProduct', [ProductController::class, 'store'])->name('Products.store'); //stores the product
    Route::get('/showProduct/{id}', [ProductController::class, 'show'])->name('Products.show'); //show a single product
    Route::get('/editProduct/{id}/edit', [ProductController::class, 'edit'])->name('Products.edit'); //displays the form to edit a product
    Route::put('/updateProduct/{id}', [ProductController::class, 'update'])->name('Products.update'); //updates the product
    Route::delete('/deleteProduct/{id}', [ProductController::class, 'destroy'])->name('Products.delete'); //deletes the product
});



//cart controller
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [cartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [cartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [cartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{id}', [cartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/clear', [cartController::class, 'clear'])->name('cart.clear');
    Route::get('/redirectToPay', [cartController::class, 'proceedToPayment'])->name('redirect.payment');
});

//logoutcontroller
Route::post('/logoutUser', [LogoutController::class, 'destroy'])->name('Auth.logout')->middleware('auth');

//mpesacontroller
Route::middleware(['auth'])->group(function () {
    Route::get('/mpesa/payment', [MpesaController::class, 'showPaymentForm'])->name('mpesa.form');
    Route::post('/mpesa/payment', [MpesaController::class, 'initiatePayment'])->name('mpesa.payment');
    Route::post('/mpesa/callback', [MpesaController::class, 'handleCallback'])->name('mpesa.callback');
});


//landingPageController
Route::get('/', [LandingPageController::class, 'index'])->name('User.welcome');
Route::get('/landing/{id}', [LandingPageController::class, 'show'])->name('landing.show');
Route::get('/search', [LandingPageController::class, 'search']);


//LoginController
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('Auth.login');
Route::post('/handlelogin', [LoginController::class, 'login'])->name('Auth.loginUser');

//registerController
Route::get('/register', [RegisterController::class, 'Register'])->name('Auth.register');
Route::post('registerUser', [RegisterController::class, 'RegisterUser']);



//paymentController


//paypalcontroller
Route::get('/create-transaction', [PaypalController::class, 'createTransaction'])->name('createTransaction');
Route::get('/process-transaction', [PaypalController::class, 'processTransaction'])->name('processTransaction');
Route::get('/success-transaction', [PaypalController::class, 'successTransaction'])->name('successTransaction');
Route::get('/cancel-transaction', [PaypalController::class, 'cancelTransaction'])->name('cancelTransaction');
