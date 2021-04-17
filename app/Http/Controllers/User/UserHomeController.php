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
        $categories = Category::with('subCategories')->withCount('posts')->whereNull('parent_id')->inRandomOrder()->get();
        $posts = Post::with('category')->get();
        // $posts = Post::all()->random(9);
        return view('user.home', compact('categories', 'posts'));
    }
}
