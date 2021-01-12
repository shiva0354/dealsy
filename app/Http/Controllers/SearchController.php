<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Post;

class SearchController extends Controller
{
    //all functions related to search

    public function search(SearchRequest $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $location = $request->input('location');
        if (($category != '') && ($location != '')) {
            $posts = Post::where('status', 'ACTIVE')
                ->where('category_id', $category)
                ->where('post_title', 'LIKE', $query)
                ->where('city', $location)->paginate(9);
        } elseif ($category != '') {
            $posts = Post::where('status', 'ACTIVE')
                ->where('category_id', $category)
                ->where('post_title', 'LIKE', $query)->paginate(9);
        } elseif ($location != '') {
            $posts = Post::where('status', 'ACTIVE')
                ->where('post_title', 'LIKE', $query)
                ->where('city', $query)->paginate(9);
        } else {
            $posts = Post::where('status', 'ACTIVE')
                ->where('post_title', 'LIKE', $query)->paginate(9);
        }
        return view('products', compact('posts'));
    }

    public function categorySearch($slug, $id)
    {
        $category = Category::findOrFail($id);
        $posts = Post::where('status', 'ACTIVE')->where('category_id', $category->id)->paginate(9);

        return view('products', compact('posts'));
    }

    public function LocationSearch($location, $location_id)
    {
        $posts = Post::where('status', 'ACTIVE')->where('location_id', $location_id)->paginate(9);

        return view('products', compact('posts'));
    }

    public function locationCategorySearch($location, $location_id, $category, $category_id)
    {
        $posts = Post::where('status', 'ACTIVE')->where('location_id', $location_id)->where('category_id', $category_id)->paginate(9);

        return view('products', compact('posts'));
    }

    public function localitySearch()
    {

    }

}
