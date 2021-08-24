<?php

use App\Http\Controllers\Admin\AdminAdminController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminSeoController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminResetPasswordController;
use Illuminate\Support\Facades\Route;

/** Admin section related routes */
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminLoginController::class, 'login']);
        Route::get('password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [AdminResetPasswordController::class, 'reset'])->name('password.update');
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
        Route::get('password/change', [AdminResetPasswordController::class, 'showChangePasswordForm'])->name('password.change');
        Route::post('password/change', [AdminResetPasswordController::class, 'changePassword']);
        Route::get('/', [AdminHomeController::class, 'index'])->name('home');

        /** Admin Management */
        Route::resource('admins', AdminAdminController::class)->except(['show']);
        Route::resource('contacts', AdminContactController::class)->only(['index', 'destroy']);
        Route::resource('users', AdminUserController::class)->only(['index', 'destroy', 'show']);
        Route::resource('categories', AdminCategoryController::class)->except(['show', 'create']);
        Route::resource('locations', AdminLocationController::class)->except(['show', 'create']);

        /** Post related */
        Route::get('posts', [AdminPostController::class, 'index'])->name('posts.index');
        Route::get('posts/{post}', [AdminPostController::class, 'postDetail'])->name('posts.show');
        Route::post('posts/{post}/{status}', [AdminPostController::class, 'changeStatus'])->name('posts.status');

        /**Seo management */
        Route::get('seo-tools/default', [AdminSeoController::class, 'seoDefaultView'])->name('seo-tools.default');
        Route::post('seo-tools/default', [AdminSeoController::class, 'seoDefault'])->name('seo-tools.default.update');
        Route::resource('seo-tools', AdminSeoController::class);
    });
});
