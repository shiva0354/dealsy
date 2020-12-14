<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function pricing()
    {
        return view('pages.pricing');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function about()
    {
        return view('pages.about');
    }
}
