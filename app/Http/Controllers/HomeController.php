<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    //show home page
    public function home()
    {
        return view('home');
    }
}
