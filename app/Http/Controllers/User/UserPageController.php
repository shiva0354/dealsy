<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserPageController extends Controller
{
    /**
     * displaying page of the websites such as about,privacy etc
     * Also setting title and description for pages
     * @param string $page
     */
    public function page($page)
    {
        seo()->title(__("seo.seo-title:$page"));
        seo()->description(__("seo.seo-description:$page"));
        seo()->canonical(url()->current());
        return view('user.pages.' . $page);
    }
}
