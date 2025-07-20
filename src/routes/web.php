<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/products/register', [ProductController::class, 'add']);
Route::get('/products/{productId}', [ProductController::class, 'show']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}/edit', [ProductController::class, 'edit']);
Route::put('/products/{product}', [ProductController::class, 'update']);
Route::delete('/products/{product}/delete', [ProductController::class, 'destroy']);
Route::put('/products/{product}/update', [ProductController::class, 'update']);
Route::post('/products', [ProductController::class, 'store']);