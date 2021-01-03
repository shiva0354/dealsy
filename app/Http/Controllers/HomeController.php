<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    //show home page
    public function home()
    {
        $categories = Category::inRandomOrder()->get();
        $posts = Post::all();
        // $posts = Post::all()->random(9);
        return view('home', compact('categories', 'posts'));
    }
}
