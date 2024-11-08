<?php

use App\Http\Controllers\System\CampaignCategoryController;
use App\Http\Controllers\System\CampaignController;
use App\Http\Controllers\System\ConfigController;
use App\Http\Controllers\System\ContactUsController;
use App\Http\Controllers\System\DonationController;
use App\Http\Controllers\System\HomeControllerBackend;
use App\Http\Controllers\System\PageController;
use App\Http\Controllers\System\PartnerController;
use App\Http\Controllers\System\PaymentGatewayController;
use App\Http\Controllers\System\PostCategoryController;
use App\Http\Controllers\System\PostController;
use App\Http\Controllers\System\ProfileController;
use App\Http\Controllers\System\RoleController;
use App\Http\Controllers\System\SliderController;
use App\Http\Controllers\System\TestimonialController;
use App\Http\Controllers\System\UserController;
use App\Http\Controllers\System\WithdrawalController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\Public\HomeController;


//Route::get('/', function () {
//    return view('index');
//});
//Route::get('/', [\App\Http\Controllers\Public\IndexController::class, 'index'])->name('index');
Route::get('/', [HomeController::class, 'index'])->name('fontendDefaultPage');
Route::get('/campaigns/{slug}', [HomeController::class, 'campaignDetailPage'])->name('campaignDetailPage');
Route::get('/campaigns', [HomeController::class, 'campaignList'])->name('campaignList');
Route::get('/contact-us', [HomeController::class, 'contactUsView'])->name('frontendContactus');
Route::post('/contact-us', [HomeController::class, 'contactUsCreate'])->name('frontendContactusCreate');
Route::get('/page/{pageType}', [HomeController::class, 'getPage'])->name('frontendPage');
Route::get('/blogs', [HomeController::class, 'postList'])->name('postList');
Route::get('/blogs/{slug}', [HomeController::class, 'postDetailPage'])->name('postDetailPage');
Route::post('/donation', [HomeController::class, 'getDonation'])->name('getDonation');
Route::get('/payment/khalti/verfication', [HomeController::class, 'khaltiPaymentVerification'])->name('khaltiPaymentVerification');
Route::post('/save-location/{campaign}', [HomeController::class, 'saveLocation'])->name('saveLocation');




Auth::routes();
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::prefix(getSystemPrefix())->middleware(['auth', 'permission.routes'])->group(function () {
    Route::get('/home', [HomeControllerBackend::class, 'index'])->name('home.index');
    Route::get('/admin', [HomeControllerBackend::class, 'index'])->name('home.index');
    Route::get('/login', [HomeControllerBackend::class, 'index'])->name('home.index');
    Route::get('/dashboard', [HomeControllerBackend::class, 'index'])->name('dashboard');
    Route::resource('/profile', ProfileController::class)->except(['show']);
    Route::get('/change-password', [ProfileController::class,'changePassword'])->name('change.password');
    Route::put('/change-password', [ProfileController::class,'changePasswordUpdate'])->name('change.password.update');
    Route::resource('/configs', ConfigController::class)->except(['show']);//configs.index, configs.create, configs.store, configs.show, configs.edit, configs.update, configs.destroy
    Route::resource('/users', UserController::class, ['except' => ['show']]);
    Route::resource('/roles', RoleController::class, ['except' => ['show']]);
    Route::resource('/pages', PageController::class, ['except' => ['show']]);
    Route::resource('/post-categories', PostCategoryController::class, ['except' => ['show']]);
    Route::resource('/posts', PostController::class, ['except' => ['show']]);
    Route::resource('/sliders', SliderController::class, ['except' => ['show']]);
    Route::resource('/contact-us', ContactUsController::class, ['except' => ['show']]);
    Route::resource('/testimonials', TestimonialController::class, ['except' => ['show']]);
    Route::resource('/partners', PartnerController::class, ['except' => ['show']]);
    Route::resource('/campaign-categories', CampaignCategoryController::class, ['except' => ['show']]);
    Route::resource('/campaigns', CampaignController::class, ['except' => ['show']]);
    Route::resource('/payment-gateways', PaymentGatewayController::class, ['except' => ['show','edit','update']]);
    Route::resource('/donations', DonationController::class);
    Route::resource('/withdrawals', WithdrawalController::class);
});
