<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductCompany\Http\Controllers\ProductCompanyController;

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


Route::prefix('admin/product-company')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [ProductCompanyController::class, 'index'])->name('productcompany.index')->middleware(['permission:view-productcompany']);
    Route::post('/', [ProductCompanyController::class, 'create'])->name('productcompany.create')->middleware(['permission:create-productcompany|update-productcompany|delete-productcompany']);
});

// Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
//     // Company Routes
//     Route::prefix('company')->group(function () {
//         Route::get('/', [CompanyController::class, 'index'])->name('company.index')->middleware(['permission:view-company']);
//         Route::post('/', [CompanyController::class, 'store'])->name('company.store')
//             ->middleware(['permission:create-company|update-company|delete-company']);
//     });
// });
