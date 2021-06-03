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
        $categories = Category::whereNull('parent_id')->inRandomOrder()->get(['id', 'slug', 'name', 'icon']);
        $categories->load(['subCategories' => function ($q) {
            $q->select('id', 'name', 'slug', 'parent_id');
            $q->withCount('posts');
        }]);
        $posts = Post::with(['firstImage', 'category' => function ($query) {
            $query->select('id', 'name', 'slug');
        }])->active()->inRandomOrder()->limit(9)->get(['id', 'title', 'price', 'category_id', 'created_at']);
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
