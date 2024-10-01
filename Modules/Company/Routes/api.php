<?php

use Illuminate\Http\Request;
use Modules\Company\Http\Controllers\CompanyController;

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

Route::middleware('auth:api')->get('/company', function (Request $request) {
    return $request->user();
});

// New route to get company name by ID
Route::get('/get-company-names/{companyIds}', [CompanyController::class, 'getCompanyNamesByIds'])->name('api.getCompanyNames');