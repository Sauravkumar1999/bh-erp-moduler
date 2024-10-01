<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\NiceVerifyController;

/*
|--------------------------------------------------------------------------
| Web Routes for Nice Verify
|--------------------------------------------------------------------------
|
*/

Route::any('/nice-verify/success', [NiceVerifyController::class, 'success'])->name('nice-verify.success');
Route::any('/nice-verify/fail', [NiceVerifyController::class, 'fail'])->name('nice-verify.fail');
