<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StripeController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/about', [ProductController::class, 'about'])->name('about');

// Cart routes
Route::get('/cart/add', [CartController::class, 'addToCart'])->name('addToCart')->middleware('auth:sanctum');
Route::get('/cart', [CartController::class, 'getCartItems'])->middleware('auth:sanctum')->name('getCartItems')->middleware('auth:sanctum');
Route::get('/cart/items', [CartController::class, 'getCartItems'])->middleware('auth:sanctum');
Route::delete('/cart/items/{productId}', [CartController::class, 'deleteProduct'])->middleware('auth:sanctum');
Route::patch('/cart/items/{productId}', [CartController::class, 'updateQuantity'])->middleware('auth:sanctum');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('auth:sanctum');
Route::get('/cart', function () {
    return view('cart'); 
})->name('cart')->middleware('auth:sanctum');;

// Stripe routes
Route::post('/api/stripe/create-checkout-session', [StripeController::class, 'createCheckoutSession'])->middleware('auth:sanctum');
Route::get('/stripe/success', [StripeController::class, 'success'])->name('payment-success')->middleware('auth:sanctum');
Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('payment-cancelled')->middleware('auth:sanctum');



//Admin routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminProducts'])->name('admin.dashboard'); 
    Route::post('/admin/products', [AdminController::class, 'store'])->name('products.store'); 
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::get('/admin/update/{id}', [AdminController::class, 'edit'])->name('admin.update'); 
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit'); 
    Route::delete('/admin/products/{id}', [AdminController::class, 'destroy'])->name('products.destroy');
    Route::put('/admin/products/{id}', [AdminController::class, 'update'])->name('products.update'); 

});



// Auth routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Logout route
    Route::get('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
