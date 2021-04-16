<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\AdminAuthGuard;

class AdminHomeController extends Controller
{
    use AdminAuthGuard;

    public function index()
    {
        return view('admin.home');
    }
}
