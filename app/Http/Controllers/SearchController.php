<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Location;
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
                ->where('title', 'LIKE', $query)
                ->where('location_id', $location)->paginate(9);
        } elseif ($category != '') {
            $posts = Post::where('status', 'ACTIVE')
                ->where('category_id', $category)
                ->where('title', 'LIKE', $query)->paginate(9);
        } elseif ($location != '') {
            $posts = Post::where('status', 'ACTIVE')
                ->where('title', 'LIKE', $query)
                ->where('city', $query)->paginate(9);
        } else {
            $posts = Post::where('status', 'ACTIVE')
                ->where('title', 'LIKE', $query)->paginate(9);
        }
        return view('products', compact('posts', 'category', 'location'));
    }

    public function categorySearch($slug, $id)
    {
        $category = Category::findOrFail($id);
        $location = null;
        $posts = Post::where('status', 'ACTIVE')->where('category_id', $category->id)->paginate(9);
        return view('products', compact('posts', 'category', 'location'));
    }

    public function LocationSearch($location, $location_id)
    {
        $category = Category::findOrFail($location_id);
        $location = Location::findOrFail($location_id);

        $posts = Post::where('status', 'ACTIVE')->where('location_id', $location_id)->paginate(9);
        return view('products', compact('posts', 'category', 'location'));
    }

    public function locationCategorySearch($location, $location_id, $category, $category_id)
    {
        $category = Category::findOrFail($category_id);
        $location = Location::findOrFail($location_id);

        $posts = Post::where('status', 'ACTIVE')->where('location_id', $location_id)->where('category_id', $category_id)->paginate(9);
        return view('products', compact('posts', 'category', 'location'));
    }

    public function localitySearch($location, $location_id, $locality, $category, $category_id)
    {
        $category = Category::findOrFail($category_id);
        $location = Location::findOrFail($location_id);

        $posts = Post::where('status', 'ACTIVE')->where('category_id', $category_id)->where('locality', $locality)->paginate(9);
        return view('products', compact('posts', 'category', 'location'));
    }

}
