<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

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
}
