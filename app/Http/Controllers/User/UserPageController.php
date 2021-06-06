<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserPageController extends Controller
{
    public function __invoke($page)
    {
        return view('user.pages.' . $page);
    }
}
