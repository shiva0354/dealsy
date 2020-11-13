<?php

namespace App\Http\Controllers;

class UserDashboardController extends Controller
{
    // show user dashboard
    public function index()
    {
        return view('dashboard.dashboard');
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

}
