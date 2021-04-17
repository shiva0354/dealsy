<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserPageController extends Controller
{
    //showing pricing page
    public function pricing()
    {
        return view('pages.pricing');
    }

    //show terms and conditions page
    public function terms()
    {
        return view('pages.terms');
    }

    //show about page
    public function about()
    {
        return view('pages.about');
    }

    public function error()
    {
        return view('pages.404');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }
}
