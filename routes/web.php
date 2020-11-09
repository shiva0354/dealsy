<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('home');
//manual login
Route::get('/login', [LoginController::class, 'showloginPage'])->name('login');
Route::post('/login', [LoginController::class, 'emailLogin'])->name('user.login');
//social login
Route::get('login/{driver}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{driver}/callback', [LoginController::class, 'handleProviderCallback']);
//manual signup
Route::view('/signup', 'signup')->name('signup');
Route::post('/signup', [LoginController::class, 'userSignup'])->name('user.signup');
Route::view('/forgot-password', 'forgot-password');
Route::post('/forgot-password', [PasswordController::class, 'forgotPassword']);

Route::view('/add-listing', 'ad-listing')->name('ad.listing');
Route::view('/dashboard', 'dashboard')->name('user.dashboard');

Route::view('/category', 'category')->name('category');
Route::view('/single-product', 'single-product')->name('single-product');

Route::view('/pricing', 'pricing')->name('pricing.package');
Route::view('/terms', 'terms')->name('terms');
Route::view('/contact', 'contact')->name('contact-us');
Route::view('/about', 'about')->name('about-us');

Route::view('user-profile', 'user-profile')->name('user.profile');

// Route::get('logout',[LoginController::class, 'logout'])->name('user.logout');
Route::get('/logout', function () {
    if (session()->has('email')) {
        Auth::logout();
        session()->pull('email');
        return redirect()->route('home');
    }
})->name('user.logout');

Route::get('user', [LoginController::class, 'userView']);
