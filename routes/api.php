<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (requires authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('product', ProductController::class); // for index, store, show, update, destroy
    Route::get('products/ascending', [ProductController::class, 'AscendingByPrice']); // for ascending order by price
    Route::get('products/descending', [ProductController::class, 'DescendingByPrice']); // for descending order by price
    Route::get('products/category/{category}', [ProductController::class, 'ProductsByCategory']); // to show products based on category
    Route::get('products/categories', [ProductController::class, 'getCategories']); // show a list of categories
    Route::get('products/search', [ProductController::class, 'search']); // for searching products
    
    // User information route
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
