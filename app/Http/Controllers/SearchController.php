<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //all functions related to search

    public function search(Request $request)
    {

    }

    public function categorySearch($id)
    {
        $category = Category::findOrFail($id);
        $posts = Post::where('status', 'ACTIVE')->where('category_id', $category->id)->paginate(10);

        return view('products', compact('posts'));
    }

    public function subCategorySearch($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $posts = Post::where('status', 'ACTIVE')->where('category_id', $sub_category->id)->paginate(10);

        return view('products', compact('posts'));
    }

    public function citySearch($city)
    {
        $posts = Post::where('status', 'ACTIVE')->where('city', $city)->paginate(10);

        return view('products', compact('posts'));
    }

    public function stateSearch($state)
    {
        $posts = Post::where('status', 'ACTIVE')->where('city', $state)->paginate(10);

        return view('products', compact('posts'));
    }

    public function cityLocalitySearch($city, $locality)
    {
        $posts = Post::where('status', 'ACTIVE')->where('city', $city)->where('locality', $locality)->paginate(10);

        return view('products', compact('posts'));
    }

    public function stateCategorySearch($state, $category_id)
    {
        $category = Category::findOrFail($category_id);

        $posts = Post::where('status', 'ACTIVE')->where('state', $state)->where('category_id', $category->id)->paginate(10);

        return view('products', compact('posts'));
    }

    public function cityCateogrySearch($city, $category_id)
    {
        $category = Category::findOrFail($category_id);

        $posts = Post::where('status', 'ACTIVE')->where('city', $city)->where('category_id', $category->id)->paginate(10);

        return view('products', compact('posts'));
    }

    public function stateSubCategorySearch($state, $sub_category_id)
    {
        $sub_category = Category::findOrFail($sub_category_id);

        $posts = Post::where('status', 'ACTIVE')->where('state', $state)->where('category_id', $sub_category->id)->paginate(10);

        return view('products', compact('posts'));
    }

    public function citySubCategorySearch($city, $sub_category_id)
    {
        $sub_category = Category::findOrFail($sub_category_id);

        $posts = Post::where('status', 'ACTIVE')->where('city', $city)->where('category_id', $sub_category->id)->paginate(10);

        return view('products', compact('posts'));
    }
}
