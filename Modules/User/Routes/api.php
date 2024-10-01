<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->group(function () {
    Route::get('users/{id}', [\Modules\User\Http\Controllers\Api\V1\UserController::class, 'show']);
});

Route::post('login', [\Modules\User\Http\Controllers\Api\V1\UserController::class, 'login']);
Route::get('/user/session', [\Modules\User\Http\Controllers\Api\V1\UserController::class, 'checkSession']);
