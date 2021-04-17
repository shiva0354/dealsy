<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
        // show user dashboard
    public function index()
    {
        $user = User::current();
        $posts = $user->posts()->paginate(6);
        return view('dashboard.dashboard', compact('posts'));
    }

    //show all ads of the particular ads
    public function myAds()
    {

    }

    //show favourite ads of user that is saved_posts
    public function savedAds()
    {

    }

    //show pending ads of the user
    public function pendingAds()
    {

    }

    //show pending ads of the user
    public function archiveAds()
    {

    }
}
