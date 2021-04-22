<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserPageController extends Controller
{
    //showing pricing page
    public function pricing()
    {
        return view('user.pages.pricing');
    }

    //show terms and conditions page
    public function terms()
    {
        return view('user.pages.terms');
    }

    //show about page
    public function about()
    {
        return view('user.pages.about');
    }

    public function error()
    {
        return view('user.pages.404');
    }

    public function privacy()
    {
        return view('user.pages.privacy');
    }

    public function sitemap()
    {
        return view('user.pages.sitemap');
    }
}
