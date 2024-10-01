<?php
use Illuminate\Support\Facades\Route;
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

//use Illuminate\Routing\Route;
use Modules\Sale\Http\Controllers\SaleController;

/*Route::prefix('sale')->group(function () {
    Route::get('/', 'SaleController@index');
});*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
// Users Routes
Route::prefix('sales')->group(function () {
    Route::get('/', [SaleController::class, 'index'])->name('sales.index')->middleware(['permission:view-sale']);
    Route::post('/', [SaleController::class, 'store'])->name('sales.store')->middleware(['permission:create-sale']);
    Route::get('/create', [SaleController::class, 'create'])->name('sales.create')->middleware(['permission:create-sale']);
    Route::get('/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit')->middleware(['permission:update-sale']);
    Route::put('/{sale}', [SaleController::class, 'update'])->name('sales.update')->middleware(['permission:update-sale']);
  //  Route::delete('/{sale}', [SaleController::class, 'destroy'])->name('sales.delete')->middleware(['permission:delete-sale']);
    Route::get('get-product/{product}', [SaleController::class, 'getProduct'])->name('sales.product');
        // ['permission:create-sale|update-sale|delete-sale']
    /*Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware(['permission:update-user']);
    Route::get('/get-code', [UserController::class, 'getUserCode'])->name('users.code');*/
});
});
