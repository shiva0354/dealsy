<?php

use App\Http\Controllers\Admin\Auth\ConfirmPasswordController as AdminConfirmPassword;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController as AdminForgotPassword;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLogin;
use App\Http\Controllers\Admin\Auth\ResetPasswordController as AdminResetPassword;
use App\Http\Controllers\Admin\Auth\VerificationController as AdminVerification;
use App\Http\Controllers\Admin\HomeController as AdminHome;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::group(['middleware' => ['authorization']], function () {
    //manual signup
    Route::get('/signup', [RegisterController::class, 'index'])->name('signup');
    Route::post('/signup', [RegisterController::class, 'create']);
    // //manual login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'emailLogin']);
    //social login
    Route::get('login/{driver}', [LoginController::class, 'redirectToProvider'])->name('social.login');
    Route::get('login/{driver}/callback', [LoginController::class, 'handleProviderCallback']);
    //forgot-password
    Route::get('/forgot-password', [PasswordController::class, 'index'])->name('forgot.password');
    Route::post('/forgot-password', [PasswordController::class, 'postEmail']);
    //reset password
    Route::get('/reset-password/{token}', [PasswordController::class, 'showResetPassword'])->name('reset.password');
    Route::post('/reset-password', [PasswordController::class, 'resetPassword']);
});
Route::group(['middleware' => ['auth']], function () {
    //logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');
    //pages that user can access after login
    Route::get('add-listing', [PostController::class, 'create'])->name('add.listing');
    Route::post('add-listing', [PostController::class, 'store']);
    Route::get('posts/{post}/images', [PostController::class, 'postImages'])->name('posts.images');
    Route::post('posts/{post}/images', [PostController::class, 'storeImage'])->name('posts.images.store');
    Route::delete('posts/{post}/images/{image}', [PostController::class, 'deleteImages'])->name('posts.images.delete');
    //Dashboard
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('dashboard/saved-ads', [UserDashboardController::class, 'savedAds'])->name('user.saved.ads');
    Route::get('dashboard/pending-ads', [UserDashboardController::class, 'pendingAds'])->name('user.pending.ads');
    Route::get('dashboard/archived-ads', [UserDashboardController::class, 'archivedAds'])->name('user.archive.ads');
    //User Profile
    Route::get('dashboard/profile', [UserController::class, 'index'])->name('user.profile');
    Route::put('dashboard/profile/change-password', [UserController::class, 'changePassword'])->name('user.change.password');
    Route::put('dashboard/profile/change-email', [UserController::class, 'changeEmail'])->name('user.change.email');
    Route::put('dashboard/profile/change-name', [UserController::class, 'changeName'])->name('user.change.name');
    Route::put('dashboard/profile/change-picture', [UserController::class, 'changePicture'])->name('user.change.picture');
    Route::delete('dashboard/profile/delete-user', [UserController::class, 'destroyUser'])->name('user.destroy');
});
// pages
Route::get('pricing', [PageController::class, 'pricing'])->name('pricing.package');
Route::get('terms', [PageController::class, 'terms'])->name('terms');
Route::get('about', [PageController::class, 'about'])->name('about-us');
Route::get('404', [PageController::class, 'error'])->name('error404');
Route::get('privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('contact', [ContactController::class, 'index'])->name('contact-us');
Route::post('contact', [ContactController::class, 'store']);
//item
Route::get('item/{id}/{title}', [ItemController::class, 'showItem'])->name('item');
//Search
Route::get('search', [SearchController::class, 'search'])->name('search');
Route::get('{category}_c{categoryId}', [SearchController::class, 'categorySearch'])->name('search.category');
Route::get('{location}_g{locationId}', [SearchController::class, 'locationSearch'])->name('search.location');
Route::get('{location}_g{locationId}/{category}_c{categoryId}', [SearchController::class, 'locationCategorySearch'])->name('search.location.category');
Route::get('{location}_g{locationId}/{locality}', [SearchController::class, 'localitySearch'])->name('search.locality');
Route::get('{location}_g{locationId}/{locality}/{category}_c{categoryId}', [SearchController::class, 'localityCategorySearch'])->name('search.locality.category');

//ajax
Route::get('ajax-location', [PostController::class, 'ajaxLocation'])->name('ajax.location');

Route::prefix('admin')->name('admin.')->middleware('adminauth')->group(function () {
    Route::get('login', [AdminLogin::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLogin::class, 'login']);
    Route::get('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);
    Route::get('password/reset', [AdminForgotPassword::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [AdminForgotPassword::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [AdminResetPassword::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [AdminResetPassword::class, 'reset'])->name('password.update');
    Route::get('password/confirm', [AdminConfirmPassword::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('password/confirm', [AdminConfirmPassword::class, 'confirm']);
    Route::get('email/verify', [AdminVerification::class, 'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [AdminVerification::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [AdminVerification::class, 'resend'])->name('verification.resend');
});

Route::post('admin/logout', [AdminLogin::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    Route::get('/', [AdminHome::class, 'index'])->name('admin.home');
});
