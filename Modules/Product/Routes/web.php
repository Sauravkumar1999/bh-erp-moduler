<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index')->middleware(['permission:view-product']);
        Route::get('/create', [ProductController::class, 'create'])->name('products.create')->middleware(['permission:create-product']);
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware(['permission:update-product']);
        Route::post('/', [ProductController::class, 'store'])->name('products.store')->middleware(['permission:create-product']);
        Route::put('/{product}', [ProductController::class, 'update'])->name('products.update')->middleware(['permission:update-product']);
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.delete')->middleware(['permission:delete-product']);
        Route::post('/banner-store', [ProductController::class, 'handleBannerImage'])->name('products.banner.store')->middleware(['permission:create-product']);
        Route::post('/{product}/banner-update', [ProductController::class, 'handleBannerImage'])->name('products.banner.update')->middleware(['permission:update-product']);
        Route::get('/get-commission-details/:{product}', [ProductController::class, 'getCommissionChargeDetails'])->name('products.commission-charge');
        Route::get('/get-manager-details/:{product}', [ProductController::class, 'getManagerDetails'])->name('products.manager');
    });
});
