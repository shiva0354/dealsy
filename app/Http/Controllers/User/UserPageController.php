<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserPageController extends Controller
{
    public function __invoke($page)
    {
        seo()->title(__("seo.seo-title:$page"));
        seo()->description(__("seo.seo-description:$page"));
        seo()->canonical(url()->current());
        return view('user.pages.' . $page);
    }
}
