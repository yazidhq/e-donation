<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::get();
    return view('home', compact('products'));
})->name('home');

Route::middleware([RoleMiddleware::class . ':user'])->group(function () {
    Route::resource('/order', OrderController::class);
    
    Route::controller(OrderController::class)->group(function() {
        Route::post('/add_quantity/{id}', 'add_quantity')->name('add_quantity');
        Route::post('/subtract_quantity/{id}', 'subtract_quantity')->name('subtract_quantity');
        Route::post('/cancel_order/{id}', 'cancel_order')->name('cancel_order');
    });

    Route::controller(TransactionController::class)->group(function() {
        Route::get('/update_payment_status/{id}', 'update_payment_status')->name('update_payment_status');
    });
    
    Route::controller(UserController::class)->group(function() {
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/update_profile/{id}', 'update_profile')->name('update_profile');

        Route::post('/store_shipment', 'store_shipment')->name('store_shipment');
        Route::post('/update_shipment/{id}', 'update_shipment')->name('update_shipment');
    });
});

Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::resource('/product', ProductController::class);

    Route::controller(AdminController::class)->group(function() {
        Route::get('/dashboard', 'dashboard')->name('dashboard');

        Route::get('/users', 'users')->name('users');
        Route::post('/store_users', 'store_users')->name('store_users');
        Route::post('/update_users/{id}', 'update_users')->name('update_users');
        Route::post('/delete_user/{id}', 'delete_user')->name('delete_user');
        Route::get('/users/orders/{id}', 'user_orders')->name('user_orders');
    });
});

Route::controller(AuthController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store_register', 'store_register')->name('store_register');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});