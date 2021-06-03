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
        $categories = cache()->remember('home-categories', 60 * 60 * 24, function () {
            return Category::with(['subCategories' => function ($q) {
                $q->select('id', 'name', 'slug', 'parent_id');
                $q->withCount('posts');
            }])->whereNull('parent_id')->inRandomOrder()->get(['id', 'slug', 'name', 'icon']);
        });

        $posts = cache()->remember('trending-posts', 60 * 60 * 24, function () {
            return Post::with(['firstImage', 'category' => function ($query) {
                $query->select('id', 'name', 'slug');
            }])->active()->inRandomOrder()->limit(9)->get(['id', 'title', 'price', 'category_id', 'created_at']);
        });

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
