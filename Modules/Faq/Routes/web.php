<?php


use Illuminate\Support\Facades\Route;
use Modules\Faq\Http\Controllers\FaqController;

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
    Route::prefix('faqs')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('faqs.index')->middleware(['permission:view-faq']);
        Route::post('/', [FaqController::class, 'store'])->name('faqs.store')->middleware(['permission:create-faq|update-faq|delete-faq']);
    });
});
