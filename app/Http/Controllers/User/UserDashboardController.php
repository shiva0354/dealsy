<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // show user dashboard
    public function index()
    {
        $user = User::current();
        $posts = $user->posts()->paginate(6);
        $posts->load(['category', 'postImages', 'city', 'state']);
        $title = 'My Ads';
        return view('user.dashboard', compact('posts', 'title', 'user'));
    }

    //show favourite ads of user that is saved_posts
    public function savedAds()
    {
        $user = User::current();
        $posts = $user->savedposts()->with(['category', 'postImages', 'postVideo'])->paginate(6);
        $title = 'Favourite Ads';
        return view('user.dashboard', compact('posts', 'title', 'user'));
    }

    //show pending ads of the user
    public function pendingAds()
    {
        $user = User::current();
        $posts = $user->posts()->whereStatus('PENDING')->paginate(6);
        $posts->load(['category', 'postImages', 'postVideo']);
        $title = 'Pending Ads';
        return view('user.dashboard', compact('posts', 'title', 'user'));
    }

    public function rejectedAds()
    {
        $user = User::current();
        $posts = $user->posts()->whereStatus('REJECTED')->paginate(6);
        $posts->load(['category', 'postImages', 'postVideo']);
        $title = 'Rejected Ads';
        return view('user.dashboard', compact('posts', 'title', 'user'));
    }

    //show pending ads of the user
    public function archivedAds()
    {
        $user = User::current();
        $posts = $user->posts()->onlyTrashed()->paginate(6);
        $posts->load(['category', 'postImages', 'postVideo']);
        $title = 'Archived Ads';
        return view('user.dashboard', compact('posts', 'title', 'user'));
    }
}
