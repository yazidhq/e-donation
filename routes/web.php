<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::get();
    return view('home', compact('products'));
})->name('home');

Route::middleware([RoleMiddleware::class . ':user'])->group(function () {
    Route::resource('/order', OrderController::class);
    Route::post('/add_quantity/{id}',[OrderController::class, 'add_quantity'])->name('add_quantity');
    Route::post('/subtract_quantity/{id}',[OrderController::class, 'subtract_quantity'])->name('subtract_quantity');
    
    Route::controller(UserController::class)->group(function(){
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/update_profile/{id}', 'update_profile')->name('update_profile');
        Route::post('/store_shipment', 'store_shipment')->name('store_shipment');
        Route::post('/update_shipment/{id}', 'update_shipment')->name('update_shipment');
        Route::post('/cancel_order/{id}', 'cancel_order')->name('cancel_order');
    });
});

Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::controller(AdminController::class)->group(function() {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });
    Route::resource('/product', ProductController::class);
});

Route::controller(AuthController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store_register', 'store_register')->name('store_register');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});