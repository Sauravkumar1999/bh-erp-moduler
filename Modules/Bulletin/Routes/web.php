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
use Modules\Bulletin\Http\Controllers\BulletinController;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::prefix('manage-bulletin')->group(function () {
        Route::get('/', [BulletinController::class, 'index'])->name('bulletin.index')->middleware(['permission:view-bulletin']);
        Route::post('/', [BulletinController::class, 'store'])->name('bulletin.store')
            ->middleware(['permission:create-bulletin|update-bulletin|delete-bulletin']);
        Route::get('show/{title_id}', [BulletinController::class, 'show'])->name('bulletin.show')
        ->middleware(['permission:view-bulletin']);
    });
});
