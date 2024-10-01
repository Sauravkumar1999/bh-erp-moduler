<?php

use Illuminate\Support\Facades\Route;
use Modules\PushNotification\Http\Controllers\PushNotificationController;

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
    Route::prefix('push-notification')->group(function () {
        Route::get('/', [PushNotificationController::class, 'index'])->name('push-notifications.index');
        // ->middleware(['permission:view-push-notification']);
        Route::post('/', [PushNotificationController::class, 'store'])->name('push-notifications.store');
        // ->middleware(['permission:create-push-notification']);

        Route::get('/users', [PushNotificationController::class, 'getUsers'])->name('push-notifications.users');
        Route::get('/roles', [PushNotificationController::class, 'getRoles'])->name('push-notifications.roles');

        Route::get('/users-roles/{notification}', [PushNotificationController::class, 'getUsersRoles'])->name('push-notifications.roles-users');

        Route::get('/send-android-notification', [PushNotificationController::class, 'sendAndroidNotification'])->name('android-push-notification');
    });
});
