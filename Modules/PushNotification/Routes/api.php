<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\PushNotification\Http\Controllers\PushNotificationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->prefix('push-notification')->group(function () {
    Route::get('/pushnotification', function (Request $request) {
        return $request->user();
    });
});
Route::middleware('auth:api')->post('/store-device-token', [PushNotificationController::class, 'storeDeviceToken'])->name('store-device-token');
Route::middleware('auth:api')->post('/update-push-yn', [PushNotificationController::class, 'updatePushYN'])->name('update-push-yn');
