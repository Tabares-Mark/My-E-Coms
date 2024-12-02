<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::post('/register/admin', [AuthController::class, 'registerAdmin']);
Route::post('/register/user', [AuthController::class, 'registerUser']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (requires authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('products', [ProductController::class, 'index']); 
    Route::get('products/ascending', [ProductController::class, 'AscendingByPrice']);
    Route::get('products/descending', [ProductController::class, 'DescendingByPrice']);
    Route::get('products/category/{category}', [ProductController::class, 'ProductsByCategory']);
    Route::get('products/categories', [ProductController::class, 'getCategories']);
    Route::get('products/search', [ProductController::class, 'search']);
    Route::post('cart/add', [CartController::class, 'addToCart']);
    Route::get('cart', [CartController::class, 'viewCart']);
    Route::put('cart/{cartId}', [CartController::class, 'updateCart']);
    Route::post('cart/checkout', [CartController::class, 'checkout']);

    // Admin-specific routes
    Route::post('product', [ProductController::class, 'store']);
    Route::put('product/{product}', [ProductController::class, 'update']);
    Route::delete('product/{product}', [ProductController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
