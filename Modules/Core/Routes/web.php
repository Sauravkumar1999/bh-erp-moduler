<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\LocaleController;
use Modules\Core\Http\Controllers\MonthlyNewsController;
use Modules\Core\Http\Controllers\PageMetaController;
use Modules\Core\Http\Controllers\SettingController;
use Modules\Core\Http\Controllers\PushNotificationController;

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

    // Settings Routes
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings.index')->middleware(['permission:view-system-variable']);
        Route::post('/', [SettingController::class, 'store'])->name('settings.store')
            ->middleware(['permission:create-system-variable|update-system-variable|delete-system-variable']);
    });

    //language controller
    Route::get('/switch-locale/{lang}', [LocaleController::class, 'switch'])->name('switch-locale');

    // Clearing application cache
    Route::get('/clear-cache', function () {

        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('event:clear');
        Artisan::call('optimize');
        Artisan::call('route:clear');
        system('composer dump-autoload');

        return redirect()->back();
    })->name('clear-cache');

    Route::get('my-php-info', function () {
        if(env('APP_DEBUG')) {
            phpinfo();
        } else {
            return redirect()->back();
        }
    });

    Route::get('my-env-data', function () {
        if (env('APP_DEBUG')) {
            return view('core::config.my-env');
        } else {
            return redirect()->back();
        }
    });

    Route::prefix('monthly-news')->group(function () {
        Route::get('/', [MonthlyNewsController::class, 'index'])->name('monthly-news.index')->middleware(['permission:view-system-variable']);
        Route::post('/', [MonthlyNewsController::class, 'store'])->name('monthly-news.store')->middleware(['permission:create-system-variable|update-system-variable|delete-system-variable']);
        Route::post('/image-store', [MonthlyNewsController::class, 'handleMonthlyNewsImage'])->name('monthly-news.image.store')->middleware(['permission:view-system-variable']);

        // permission:view-system-variable
    });

    Route::prefix('page-meta-tags')->group(function () {
        Route::get('/', [PageMetaController::class, 'index'])->name('page-meta-tags.index');
        Route::get('/create', [PageMetaController::class, 'create'])->name('page-meta-tags.create');
        Route::get('/{pagemeta}/edit', [PageMetaController::class, 'edit'])->name('page-meta-tags.edit');
        Route::delete('/{pageMeta}/delete', [PageMetaController::class, 'destroy'])->name('page-meta-tags.destroy');
        Route::post('/', [PageMetaController::class, 'store'])->name('page-meta-tags.store');
        Route::post('/{pagemeta}/update', [PageMetaController::class, 'update'])->name('page-meta-tags.update');
        Route::post('/image-store', [PageMetaController::class, 'handleImage'])->name('page-meta-tags.image.store');
        Route::post('/{pagemeta}/image-update', [PageMetaController::class, 'handleImage'])->name('page-meta-tags.image.update');
    });
});
