<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App;

class UserHomeController extends Controller
{
    //show home page
    public function home()
    {
        $categories = Category::whereNull('parent_id')->inRandomOrder()->get();
        $categories->load(['subCategories' => function ($q) {
            $q->withCount('posts');
        }]);
        // $posts = Post::with('category', 'postImages')->get();
        $posts = Post::with(['category', 'postImages'])->inRandomOrder()->limit(9)->get();
        return view('user.home', compact('categories', 'posts'));
    }

    public function setlocale($locale)
    {
        if (!in_array($locale, ['en', 'hi'])) {
            return 'Language Not Available';
        }
        session()->put('lang', $locale);
        setcookie('lang', $locale, time() + (86400 * 30), '/');
        App::setLocale($locale);
        return 'success';
    }
}
