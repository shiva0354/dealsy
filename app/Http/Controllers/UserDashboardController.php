<?php

namespace App\Http\Controllers;

use App\Library\UserAuthGuard;
use App\Models\User;

class UserDashboardController extends Controller
{
    use UserAuthGuard;
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
