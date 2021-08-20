<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserPageController extends Controller
{
    /**
     * displaying page of the websites such as about,privacy etc
     * @param string $page
     */
    public function page($page)
    {
        return view('user.pages.' . $page);
    }
}
