<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Allowance\Http\Controllers\AllowanceController;
use Modules\Allowance\Http\Controllers\AllowancePaymentController;
use Modules\Allowance\Http\Controllers\AllowanceStatementController;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('allowances')->group(function () {
        Route::get('/', [AllowanceController::class, 'index'])->name('allowances.index');
        // ->middleware(['permission:view-allowance']);
        Route::post('/', [AllowanceController::class, 'store'])->name('allowances.store')->middleware(['permission:create-allowance']);
        Route::get('/create', [AllowanceController::class, 'create'])->name('allowances.create')->middleware(['permission:create-allowance']);

        Route::post('/importdata', [AllowanceController::class, 'importData'])->name('allowances.importData');

        Route::get('/{allowance}/edit', [AllowanceController::class, 'edit'])->name('allowances.edit')->middleware(['permission:update-allowance']);
        Route::put('/{allowance}', [AllowanceController::class, 'update'])->name('allowances.update')->middleware(['permission:update-allowance']);
        Route::delete('/{allowance}', [AllowanceController::class, 'destroy'])->name('allowances.delete')->middleware(['permission:delete-allowance']);
    });
    Route::prefix('allowance-payments')->group(function () {
        Route::get('/', [AllowancePaymentController::class, 'index'])->name('allowance-payments.index');
        Route::get('/show/{id}', [AllowancePaymentController::class, 'show'])->name('allowance-payments.show');
        Route::post('/', [AllowancePaymentController::class, 'store'])->name('allowance-payments.store');
    });
    Route::prefix('allowance-statement')->group(function () {
        Route::get('/', [AllowanceStatementController::class, 'index'])->name('allowance-statement.index');
        Route::get('/get-allowance/{month}', [AllowanceStatementController::class, 'get_allowance'])->name('allowance-statement.get-allowance');
    });
});
