<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminResetPasswordController;
use App\Http\Controllers\User\Auth\UserForgotPasswordController;
use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\Auth\UserRegisterController;
use App\Http\Controllers\User\Auth\UserResetPasswordController;
use App\Http\Controllers\User\UserContactController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserPageController;
use App\Http\Controllers\User\UserPostController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserHomeController::class, 'home'])->name('home');
//manual signup
Route::get('/signup', [UserRegisterController::class, 'showRegistrationForm'])->name('signup');
Route::post('/signup', [UserRegisterController::class, 'register']);
// //manual login
Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLoginController::class, 'login']);
//social login
Route::get('login/{driver}', [UserLoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{driver}/callback', [UserLoginController::class, 'handleProviderCallback']);
//forgot-password
Route::get('password/reset', [UserForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('password/email', [UserForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
//reset password
Route::get('password/reset/{token}', [UserResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [UserResetPasswordController::class, 'reset'])->name('password.update');
//logout
Route::get('/logout', [UserLoginController::class, 'logout'])->name('logout');
//pages that user can access after login
Route::get('add-listing', [UserPostController::class, 'create'])->name('add.listing');
Route::post('add-listing', [UserPostController::class, 'store']);
Route::get('posts/{post}/images', [UserPostController::class, 'postImages'])->name('posts.images');
Route::post('posts/{post}/images', [UserPostController::class, 'storeImage'])->name('posts.images.store');
Route::delete('posts/{post}/images/{image}', [UserPostController::class, 'deleteImages'])->name('posts.images.delete');
//Dashboard
Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('dashboard/saved-ads', [UserDashboardController::class, 'savedAds'])->name('user.saved.ads');
Route::get('dashboard/pending-ads', [UserDashboardController::class, 'pendingAds'])->name('user.pending.ads');
Route::get('dashboard/archived-ads', [UserDashboardController::class, 'archivedAds'])->name('user.archive.ads');
//User Profile
Route::get('dashboard/profile', [UserProfileController::class, 'index'])->name('user.profile');
Route::put('dashboard/profile/change-password', [UserProfileController::class, 'changePassword'])->name('user.change.password');
Route::put('dashboard/profile/change-email', [UserProfileController::class, 'changeEmail'])->name('user.change.email');
Route::put('dashboard/profile/change-name', [UserProfileController::class, 'changeName'])->name('user.change.name');
Route::put('dashboard/profile/change-picture', [UserProfileController::class, 'changePicture'])->name('user.change.picture');
Route::delete('dashboard/profile/delete-user', [UserProfileController::class, 'destroyUser'])->name('user.destroy');

// pages
Route::get('pricing', [UserPageController::class, 'pricing'])->name('pricing.package');
Route::get('terms', [UserPageController::class, 'terms'])->name('terms');
Route::get('about', [UserPageController::class, 'about'])->name('about-us');
Route::get('404', [UserPageController::class, 'error'])->name('error404');
Route::get('privacy', [UserPageController::class, 'privacy'])->name('privacy');
Route::get('contact', [UserContactController::class, 'index'])->name('contact-us');
Route::post('contact', [UserContactController::class, 'store']);
//item
Route::get('item/{id}/{title}', [ItemController::class, 'showItem'])->name('item');
//Search
Route::get('search', [UserSearchController::class, 'search'])->name('search');
Route::get('{category}_c{categoryId}', [UserSearchController::class, 'categorySearch'])->name('search.category');
Route::get('{location}_g{locationId}', [UserSearchController::class, 'locationSearch'])->name('search.location');
Route::get('{location}_g{locationId}/{category}_c{categoryId}', [UserSearchController::class, 'locationCategorySearch'])->name('search.location.category');
Route::get('{location}_g{locationId}/{locality}', [UserSearchController::class, 'localitySearch'])->name('search.locality');
Route::get('{location}_g{locationId}/{locality}/{category}_c{categoryId}', [UserSearchController::class, 'localityCategorySearch'])->name('search.locality.category');

//ajax
Route::get('ajax-location', [UserPostController::class, 'ajaxLocation'])->name('ajax.location');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login']);
    Route::get('password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [AdminResetPasswordController::class, 'reset'])->name('password.update');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');
});
