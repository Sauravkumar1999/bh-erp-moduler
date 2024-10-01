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
use Modules\Media\Handlers\FilePreviewHandler;
use Modules\Media\Http\Controllers\MediaViewController;


Route::prefix('media')->group(function () {
    Route::get('/image/{media}', [MediaViewController::class, 'displayImage'])
        ->name('media.image.display');

    Route::get('/show/{filename}', [MediaViewController::class, 'showImage'])
        ->name('media.file.display');

    Route::get('/download-s3-objects/{file}', [MediaViewController::class, 'downloadS3Objects'])
        ->name('media.s3-objects.download');
});

Route::get('/livewire/preview-file/{filename}', [FilePreviewHandler::class, 'handle'])
    ->name('livewire.preview-file')
    ->middleware(config('livewire.middleware_group', ''));
