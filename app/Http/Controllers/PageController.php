<?php

namespace App\Http\Controllers;

class PageController extends Controller
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
}
