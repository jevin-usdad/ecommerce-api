<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\SellerAuthController;

use App\Http\Controllers\Admin\SellerController;

use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\ProductPdfController;

Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/seller/login', [SellerAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::post('/sellers', [SellerController::class, 'store']);
        Route::get('/sellers', [SellerController::class, 'index']);
    });

    Route::prefix('seller')->group(function () {
        Route::post('/products', [ProductController::class, 'store']);
        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/products/{id}/pdf', [ProductPdfController::class, 'show']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    });
});
