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

    /**
     * displaying logged in user dashboard with their ads
     */
    public function index()
    {
        $user = User::current();
        $posts = $user->posts()->paginate(6);
        $posts->load(['category', 'postImages', 'city', 'state']);
        $title = 'My Ads';
        return view('user.dashboard', compact('posts', 'title', 'user'));
    }

    /**
     * displaying favourite ads of user that is saved_posts
     */
    public function savedAds()
    {
        $user = User::current();
        $posts = $user->savedposts()->with(['category', 'postImages'])->paginate(6);
        $title = 'Favourite Ads';
        return view('user.dashboard', compact('posts', 'title', 'user'));
    }

    /**
     *  displaying pending ads of the user
     */
    public function pendingAds()
    {
        $user = User::current();
        $posts = $user->posts()->whereStatus('PENDING')->paginate(6);
        $posts->load(['category', 'postImages']);
        $title = 'Pending Ads';
        return view('user.dashboard', compact('posts', 'title', 'user'));
    }

    /**
     * Displaying rejected ads of the user
     */
    public function rejectedAds()
    {
        $user = User::current();
        $posts = $user->posts()->whereStatus('REJECTED')->paginate(6);
        $posts->load(['category', 'postImages']);
        $title = 'Rejected Ads';
        return view('user.dashboard', compact('posts', 'title', 'user'));
    }

    /**
     * Displaying archived ads of the user
     */
    public function archivedAds()
    {
        $user = User::current();
        $posts = $user->posts()->onlyTrashed()->paginate(6);
        $posts->load(['category', 'postImages']);
        $title = 'Archived Ads';
        return view('user.dashboard', compact('posts', 'title', 'user'));
    }

    /**
     * Displaying message request received from the buyer
     */
    public function getMessageRequest()
    {
        $user = User::current();
        $messages = $user->messages()->paginate(10);
        return view('user.dashboard-messages', compact('messages', 'user'));
    }
}
