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
        $posts->load(['category', 'postImages', 'postVideo']);
        return view('dashboard.dashboard', compact('posts'));
    }

    //show favourite ads of user that is saved_posts
    public function savedAds()
    {
        $user = User::current();
        $posts = $user->savedposts()->paginate(6);
        $posts->load(['category', 'postImages', 'postVideo']);
        return view('dashboard.dashboard', compact('posts'));
    }

    //show pending ads of the user
    public function pendingAds()
    {
        $user = User::current();
        $posts = $user->posts()->whereStatus('PENDING')->paginate(6);
        $posts->load(['category', 'postImages', 'postVideo']);
        return view('dashboard.dashboard', compact('posts'));
    }

    //show pending ads of the user
    public function archiveAds()
    {
        $user = User::current();
        $posts = $user->posts()->onlyTrashed()->paginate(6);
        $posts->load(['category', 'postImages', 'postVideo']);
        return view('dashboard.dashboard', compact('posts'));
    }
}
