<?php

use App\Http\Controllers\PageSubmissionController;
use Illuminate\Support\Facades\Route;
use Modules\Core\Entities\MonthlyNews;
use Modules\Product\Entities\Product;
use Modules\Sale\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Log;
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

Route::group(['middleware' => 'theme:vuexy'], function () {
    Route::get('/home', function () {
         Log::error('123 test ERROR BH DEV');
         Log::channel('cloudwatch')->info('Home page test log to CloudWatch');
        return view('welcome');
    });
});

Route::group(['middleware' => 'theme:bhub'], function () {

    Route::get('/', function () {
        // redirect to sales person page if URL has bhid
        if (request()->has('bhid')) {
            return redirect()->route('sales.page', request()->get('bhid'));
        }
        return view('welcome');
    })->name('home');

    // short route to opens sales person page
    Route::get('/{code}', [SaleController::class, 'UserSalePage'])->where('code', '[0-9]{11}');

    Route::get('/faq', function () {
        return view('faq');
    })->name('faq');

    Route::get('/instructions', function () {
        return view('instructions');
    })->name('instructions');
    Route::post('/instructions', [PageSubmissionController::class, 'submitInstructionForm'])->name('instructions.send');


    Route::get('/way-to-come', function () {
        return view('way-to-come');
    })->name('way-to-come');

    Route::get('/find-password', function () {
        return view('password.find');
    })->name('find-password');

    Route::get('my-academy', fn () => view('academy.index'))->name('academy.view');
    Route::get('monthly-news', fn () => view('monthly-news.index', ['monthly_news' => MonthlyNews::latest()->get()]))->name('monthly-news.view');
    Route::get('recruitment-representatives', fn () => view('recruitment-representatives.index'))->name('recruitment-representatives.view');
    Route::get('sale/details', fn () => view('sales.details'))->name('sale.details');
    Route::get('greeting', fn () => view('new.greeting'))->name('greeting');
    Route::get('business-model', fn () => view('new.business-model'))->name('business-model');
    Route::get('competitiveness', fn () => view('new.competitiveness'))->name('competitiveness');
    Route::get('branch-representative', fn () => view('new.branch-representative'))->name('branch-representative');
    Route::get('representative-registration', fn () => view('new.representative-registration'))->name('representative-registration');
    Route::get('compensation', fn () => view('new.compensation'))->name('compensation');
    Route::get('install-app', fn () => view('new.install-app'))->name('install-app');
    Route::get('my-portfolio/{id}', fn () => view('my-portfolio'))->name('my-portfolio.view');
    Route::get('terms', fn () => view('new.terms'))->name('terms');

    Route::post('recruitment-representatives', [PageSubmissionController::class, 'recruitmentRepSubmit'])->name('recruitment-representatives.submit');

    // sales group
    Route::prefix('sales')->name('sales.')->group(function () {
        // Route::get('my-page/{id}', fn ($id) => view('sales.view'))->middleware('sales-person')->name('page');
        Route::get('my-page/{id}', [SaleController::class, 'UserSalePage'])->middleware('sales-person')->name('page');
        Route::get('item-listing', fn () => view('sales.item-listing', ['products' => Product::latest()->get()]))->name('item-listing');
        Route::get('branch-representative-registration', fn () => view('sales.branch-representative-registration'))->name('branch-representative-registration');
        Route::get('hanbada-integration-consulting', fn () => view('sales.hanbada-integration-consulting'))->name('hanbada');
        Route::get('cell-bio-technology', fn () => view('sales.bio-tech'))->name('bio-tech');
        Route::get('knee-stem-cells', fn () => view('sales.knee-stem-cells'))->name('knee-stem-cells');
        Route::get('safety-cover', fn () => view('sales.safety-cover'))->name('safety-cover');
        Route::get('interior', fn () => view('sales.interior'))->name('interior');
        Route::get('b2b-rental-solutions', fn () => view('sales.b2b-rental-solutions'))->name('b2b-rental-solutions');
        Route::get('automatic-fire-extinguishing-installation/more-information', fn () => view('sales.automatic-fire-extinguishing-installation.more-information'))->name('automatic-fire-extinguishing-installation.more-info');
        Route::get('automatic-fire-extinguishing-installation', fn () => view('sales.automatic-fire-extinguishing-installation.index'))->name('automatic-fire-extinguishing-installation.index');
        Route::get('wine-store', fn () => view('sales.wine-store'))->name('wine-store');
        Route::get('battery-fire-extinguisher', fn () => view('sales.battery-fire-extinguisher'))->name('battery-fire-extinguisher');
        Route::get('bh-auto', fn () => view('sales.bh-auto'))->name('bh-auto');
        Route::get('bh-auto/consent', fn () => view('sales.bh-consent'))->name('bh-consent');
        Route::get('bh-auto-contact-us', fn () => view('sales.bh-auto-contact-us'))->name('bh-auto-contact-us');
        Route::get('54-dna', fn () => view('sales.54-dna'))->name('54-dna');
        Route::get('skeeper', fn () => view('sales.skeeper'))->name('skeeper');
        Route::get('init-products', [PageSubmissionController::class, 'getInitProducts'])->name('products.receive.init');


        // Form submissions
        Route::post('hanbada-integration-consulting', [PageSubmissionController::class, 'submitHanbadaForm'])->name('hanbada.send');
        Route::post('knee-stem-cells', [PageSubmissionController::class, 'submitKneeStemForm'])->name('knee-stem-cells.send');
        Route::post('safety-cover', [PageSubmissionController::class, 'submitSafetyCoverForm'])->name('safety-cover.send');
        Route::post('skeeper', [PageSubmissionController::class, 'submitSkeeperForm'])->name('skeeper.send');
        Route::post('cell-bio-technology', [PageSubmissionController::class, 'submitBioTechForm'])->name('bio-tech.send');
        Route::post('b2b-rental-solutions', [PageSubmissionController::class, 'submitRentalForm'])->name('rental-form.send');
        Route::post('auto-contact', [PageSubmissionController::class, 'submitAutoContactForm'])->name('auto-contact.send');
        Route::post('wine-store', [PageSubmissionController::class, 'submitWineStoreForm'])->name('wine-store.send');
        Route::post('automatic-fire-extinguishing-installation', [PageSubmissionController::class, 'submitAutomaticFireExtinguisherForm'])->name('automatic-fire-extinguishing-installation.send');
        Route::post('battery-fire-extinguisher', [PageSubmissionController::class, 'BatteryFireForm'])->name('battery-fire-extinguisher.send');
        Route::post('interior', [PageSubmissionController::class, 'InteriorPageForm'])->name('interior.send');
    });
});

Route::group(['middleware' => 'theme:48-pay', 'prefix' => '48-pay', 'as' => '48-pay.'], function () {
    Route::get('installment/plan', function () {
        return view('installment.plan');
    })->name('installment.plan');

    Route::get('installment/payment', function () {
        return view('installment.payment');
    })->name('installment.payment');

    Route::get('installment/merchant', function () {
        return view('merchant.view');
    })->name('merchant.view');

    Route::get('consultation/merchant', function () {
        return view('merchant.consultation');
    })->name('consultation.view');

    Route::post('inquiry', [PageSubmissionController::class, 'submitInquiryForm'])->name('inquiry.send');
});

Route::get('/sms/{number}', [App\Http\Controllers\HomeController::class, 'sendSMS']);
Route::get('/email/{email}', [App\Http\Controllers\HomeController::class, 'sendEmail']);


// Laravel health check
Route::get('/health', function () {

    return response([
        'healthy' => true,
    ])
        ->header('Content-Type', 'application/json')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
});
