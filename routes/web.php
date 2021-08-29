<?php

use App\Http\Controllers\User\Auth\UserForgotPasswordController;
use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\Auth\UserRegisterController;
use App\Http\Controllers\User\Auth\UserResetPasswordController;
use App\Http\Controllers\User\UserAjaxController;
use App\Http\Controllers\User\UserContactController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserMessageController;
use App\Http\Controllers\User\UserPageController;
use App\Http\Controllers\User\UserPostController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserSearchController;
use App\Http\Controllers\User\UserWishlistController;
use Illuminate\Support\Facades\Route;

// Route::get('write', [AdminCategoryController::class, 'categoryWrite']);
Route::get('/', [UserHomeController::class, 'home'])->name('home');

/** ajax response for categories, cities and post titles */
Route::any('categories', [UserAjaxController::class, 'ajaxCategory'])->name('ajax.categories');
Route::any('cities', [UserAjaxController::class, 'ajaxcities'])->name('ajax.cities');
Route::any('titles', [UserAjaxController::class, 'ajaxPostsTitle'])->name('ajax.post.titles');
Route::any('categories/{id}', [UserAjaxController::class, 'categories']);
Route::any('cities/{id}', [UserAjaxController::class, 'cities']);

/** manual signup*/
Route::get('/signup', [UserRegisterController::class, 'showRegistrationForm'])->name('signup');
Route::post('/signup', [UserRegisterController::class, 'register']);

/**manual login */
Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLoginController::class, 'login']);

/** social login */
Route::get('login/{driver}', [UserLoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{driver}/callback', [UserLoginController::class, 'handleProviderCallback']);

/** forgot-password */
Route::get('password/reset', [UserForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('password/email', [UserForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

/** reset password */
Route::get('password/reset/{token}', [UserResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [UserResetPasswordController::class, 'reset'])->name('password.update');

/** logout */
Route::get('/logout', [UserLoginController::class, 'logout'])->name('logout');

/** Setting app locale */
Route::get('set/locale/{locale}', [UserHomeController::class, 'setlocale']);

/** Dashboard */
Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('dashboard/ads/saved', [UserDashboardController::class, 'savedAds'])->name('user.saved.ads');
Route::get('dashboard/ads/pending', [UserDashboardController::class, 'pendingAds'])->name('user.pending.ads');
Route::get('dashboard/ads/archived', [UserDashboardController::class, 'archivedAds'])->name('user.archive.ads');
Route::get('dashboard/ads/rejected', [UserDashboardController::class, 'rejectedAds'])->name('user.rejected.ads');
Route::get('dashboard/messages', [UserDashboardController::class, 'getMessageRequest'])->name('user.messages');

/** User Profile */
Route::get('dashboard/profile', [UserProfileController::class, 'index'])->name('user.profile');
Route::post('dashboard/profile/password', [UserResetPasswordController::class, 'changePassword'])->name('user.change.password');
Route::put('dashboard/profile/email', [UserProfileController::class, 'changeEmail'])->name('user.change.email');
Route::put('dashboard/profile/name', [UserProfileController::class, 'changeName'])->name('user.change.name');
Route::put('dashboard/profile/picture', [UserProfileController::class, 'changePicture'])->name('user.change.picture');
Route::put('dashboard/profile/mobile', [UserProfileController::class, 'changeMobile'])->name('user.change.mobile');
Route::delete('dashboard/profile/delete', [UserProfileController::class, 'destroyUser'])->name('user.destroy');

/** posts related route */
Route::get('add-listing', [UserPostController::class, 'create'])->name('add.listing');
Route::post('add-listing', [UserPostController::class, 'store']);
Route::post('posts/{post}/images/{image}', [UserPostController::class, 'deleteImage'])->name('posts.images.delete');
Route::get('item/{id}/{title}', [UserPostController::class, 'show'])->name('posts.show');
Route::get('dashboard/post/{id}/edit', [UserPostController::class, 'edit'])->name('posts.edit');
Route::put('dashboard/post/{id}', [UserPostController::class, 'update'])->name('posts.update');
Route::get('dashboard/post/{id}/delete', [UserPostController::class, 'destroy'])->name('posts.destroy');

/** all post by user */
Route::get('posts/users/{userId}', [UserPostController::class, 'userPosts'])->name('users.posts');

/** Search **/
Route::get('search', [UserSearchController::class, 'search'])->name('search');
Route::get('{category}_c{categoryId}', [UserSearchController::class, 'categorySearch'])->name('search.category');
Route::get('{location}_g{locationId}', [UserSearchController::class, 'locationSearch'])->name('search.location');
Route::get('{location}_g{locationId}/{category}_c{categoryId}', [UserSearchController::class, 'locationCategorySearch'])->name('search.location.category');
Route::get('{location}_g{locationId}/{locality}', [UserSearchController::class, 'localitySearch'])->name('search.locality');
Route::get('{location}_g{locationId}/{locality}/{category}_c{categoryId}', [UserSearchController::class, 'localityCategorySearch'])->name('search.locality.category');

/** Message requests by user */
Route::post('send/message/{postId}', [UserMessageController::class, 'store'])->name('user.send.message');
Route::post('send/message/{postId}/auth', [UserMessageController::class, 'authStore'])->name('user.auth.send.message');
Route::get('posts/wishlist/{post}', [UserWishlistController::class, 'wishlist'])->name('wishlist.add');

/** general page related route */
Route::post('contact', [UserContactController::class, 'store']);
Route::get('{page}', [UserPageController::class, 'page'])
    ->name('pages')
    ->where('page', 'contact|about|terms|privacy|sitemap|pricing|404');

/** Admin routes */
require __DIR__ . '/admin.php';

Route::fallback(function () {
    return view('errors.fallback');
});
