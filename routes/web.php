<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User Auth Routes
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout', [\App\Http\Controllers\OrderController::class, 'create'])->name('checkout.index');
    Route::post('/checkout', [\App\Http\Controllers\OrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\AdminController::class, 'login'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AdminController::class, 'authenticate'])->name('authenticate');
    Route::post('/logout', [\App\Http\Controllers\AdminController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [\App\Http\Controllers\AdminController::class, 'index'])->name('products.index');
    Route::get('/products/create', [\App\Http\Controllers\AdminController::class, 'create'])->name('products.create');
    Route::post('/products', [\App\Http\Controllers\AdminController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [\App\Http\Controllers\AdminController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [\App\Http\Controllers\AdminController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [\App\Http\Controllers\AdminController::class, 'destroy'])->name('products.destroy');

    Route::get('/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{id}', [\App\Http\Controllers\AdminOrderController::class, 'update'])->name('orders.update');
});

Route::get('/about', [\App\Http\Controllers\GuestController::class, 'about'])->name('guest.about');
Route::get('/contact', [\App\Http\Controllers\GuestController::class, 'contact'])->name('guest.contact');
Route::get('/products/{id}', [\App\Http\Controllers\GuestController::class, 'show'])->name('products.show');
