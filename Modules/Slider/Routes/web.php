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

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('slider')->name('slider.')->controller(SliderController::class)->group(function () {
        Route::get('/', 'index')->name('view');
        Route::get('/create', 'create')->name('create');
        Route::get('/edit/{slider}', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::post('/update/{slider}', 'update')->name('update');
        Route::delete('/delete/{slider}', 'destroy')->name('delete');
        Route::delete('/item/delete/{item}', 'destroyItem')->name('item.delete');
        Route::post('/item-image-store', 'handleSliderItemImage')->name('item.image.store');
        Route::post('/{slideritem}/item-image-update', 'handleSliderItemImage')->name('item.image.update');
    });
});
