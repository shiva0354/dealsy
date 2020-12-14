<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])->name('home');
//manual signup
Route::get('/signup', [RegisterController::class, 'index'])->name('signup');
Route::post('/signup', [RegisterController::class, 'create'])->name('user.signup');
// //manual login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'emailLogin'])->name('user.login');
//social login
Route::get('login/{driver}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{driver}/callback', [LoginController::class, 'handleProviderCallback']);
//forgot-password
Route::get('/forgot-password', [PasswordController::class, 'index'])->name('forgot.password');
Route::post('/forgot-password', [PasswordController::class, 'postEmail'])->name('user.forgotPassword');
//reset password
Route::get('/reset-password/{token}', [PasswordController::class, 'showResetPassword'])->name('reset.password');
Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('user.resetPassword');
//logout
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');
//pages that user can access after login
Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('/add-listing', [ProductController::class, 'create'])->name('ad.listing');
Route::get('user-profile', [UserController::class, 'index'])->name('user.profile');

Route::view('/category', 'category')->name('category');
Route::view('/single-product', 'item')->name('single-product');
//miscellaneous pages
Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing.package');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/contact', [ContactController::class, 'index'])->name('contact-us');
Route::post('/contact', [ContactController::class, 'store'])->name('contact');
Route::get('/about', [PageController::class, 'about'])->name('about-us');
