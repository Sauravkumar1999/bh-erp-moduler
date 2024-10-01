<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyCsrfToken;
use Modules\User\Http\Controllers\RoleController;
use Modules\User\Http\Controllers\UserController;
use Modules\User\Http\Controllers\LoginController;
use Modules\User\Http\Controllers\MyInfoController;
use Modules\User\Http\Controllers\ReferralController;
use Modules\User\Http\Controllers\PermissionController;
use Modules\User\Http\Controllers\RegistrationController;
use Modules\User\Http\Controllers\RoyalMemberController;
use Modules\Dashboard\Http\Controllers\DashboardController;

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

//Route::prefix('user')->group(function() {
//    Route::get('/', 'UserController@index');
//});


Route::get('biz-planner-registration', [RegistrationController::class, 'index'])->name('registration');
Route::post('email_available/check', [RegistrationController::class, 'emailAvailable'])->name('email_available.check')
    ->withoutMiddleware(VerifyCsrfToken::class);
Route::post('referral_code/check', [RegistrationController::class, 'verifyReferralCode'])->name('referral_code.check')
    ->withoutMiddleware(VerifyCsrfToken::class);
Route::post('password/check', [RegistrationController::class, 'verifyPassword'])->name('password.check');

Route::post('registration', [RegistrationController::class, 'store'])->name('registration.store')->withoutMiddleware(VerifyCsrfToken::class);
Route::post('user/import', [RegistrationController::class, 'importUsers'])->name('user.import')->middleware(['permission:create-user|update-user|delete-user']);
Route::get('/user/download-template', [RegistrationController::class,'downloadTemplate'])->name('user.download-template')->middleware(['permission:create-user|update-user|delete-user']);;


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('find-password', [LoginController::class, 'showFindPassword'])->name('find-password');
Route::post('reset-password', [LoginController::class, 'resetPassword'])->name('reset-password');
Route::get('find-id', [LoginController::class, 'showFindId'])->name('find-id');
Route::post('/send-otp', [LoginController::class, 'sendOTP'])->name('send-otp');
Route::post('/verify-phone', [LoginController::class, 'verifyPhone'])->name('verify-phone')->withoutMiddleware(['guest',VerifyCsrfToken::class]);
Route::post('/update-phone', [LoginController::class, 'updatePhone'])->name('update-phone')->withoutMiddleware('guest');
Route::post('/verify-otp', [LoginController::class, 'verifyOTP'])->name('verify-otp');
Route::post('/find-user-id', [LoginController::class, 'findUserId'])->name('find-user-id');


Route::post('login', [LoginController::class, 'login'])->name('login.store');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Permissions Routes
    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index')
            ->middleware(['permission:view-permission']);
        Route::post('/', [PermissionController::class, 'store'])->name('permissions.store')
            ->middleware(['permission:create-permission|update-permission|delete-permission']);
    });

    // Roles Routes
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware(['permission:view-user-role']);
        Route::post('/', [RoleController::class, 'store'])->name('roles.store')
            ->middleware(['permission:create-user-role|update-user-role|delete-user-role']);
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware(['permission:update-user-role']);
    });

    // Users Routes
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware(['permission:view-user']);
        Route::post('/', [UserController::class, 'store'])->name('users.store')->middleware(['permission:create-user|update-user|delete-user']);
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/get-product/{id}', [UserController::class, 'getProduct'])->name('users.product');
        Route::put('/prod-settings', [UserController::class, 'updateProdSettings'])->name('users-product-settings');
    });

    // MyInfo Routes
    Route::prefix('my-info')->group(function () {
        Route::get('/{user}/edit', [MyInfoController::class, 'edit'])->name('my-info.edit')->middleware(['permission:view-my-info']);
        Route::put('/{user}/update', [MyInfoController::class, 'update'])->name('my-info.update')->middleware(['permission:update-my-info']);
        Route::get('/{user}/manage', [MyInfoController::class, 'manage'])->name('my-info.manage');

        Route::post('/{user}/manage-update', [MyInfoController::class, 'manageUpdate'])->name('my-info.manageupdate');
        Route::post('/updateOrder', [MyInfoController::class, 'updateOrder'])->name('my-info.updateOrder');

        // this updates same idcard image user has
        Route::post('/{user}/idcard/update', [MyInfoController::class, 'updateIdCardImage'])->name('my-info.idcard-update')
            ->middleware(['permission:update-my-info']);

        // this image is related to sales person, obviously a sales person is also a user. But the image is different
        Route::post('/{user}/personImage/update', [MyInfoController::class, 'salesPersonImage'])->name('my-info.salesperson-image')
            ->middleware(['permission:update-my-info']);


    });
    Route::get('apply-royal-member',[RoyalMemberController::class ,'apply_royal_member'])->name('apply-royal-member')->middleware(['royal-member-application']);
    Route::post('apply-royal-member',[RoyalMemberController::class ,'store'])->name('apply-royal-member.store')->middleware(['royal-member-application']);

    // Referral Routes
    Route::prefix('referrals')->group(function () {
        Route::get('/', [ReferralController::class, 'index'])
            ->name('referrals.index')
            ->middleware(['permission:view-referrals']);
        Route::get('/{user}/view', [ReferralController::class, 'view'])
            ->name('referrals.view')
            ->middleware(['permission:view-referral-detail']);
    });
});
