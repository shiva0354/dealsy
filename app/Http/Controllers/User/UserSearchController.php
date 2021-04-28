<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Location;
use App\Models\Post;

/**
 * @param SearchRequest $request
 * @return Post $posts
 */

class UserSearchController extends Controller
{

    public function search(SearchRequest $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $location = $request->input('location');
        if (($category != '') && ($location != '')) {
            $posts = Post::where('status', 'ACTIVE')
                ->where('category_id', $category)
                ->where('title', 'LIKE', $query)
                ->where('city_id', $location)->paginate(9);
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
        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function categorySearch($slug, $id)
    {
        $category = Category::findOrFail($id);
        $location = null;
        $posts = Post::where('status', 'ACTIVE')->where('category_id', $category->id)->paginate(9);
        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function LocationSearch($location, $locationId)
    {
        // $category = Category::findOrFail($locationId);
        $category = null;
        $location = Location::findOrFail($locationId);

        $posts = Post::where('status', 'ACTIVE')->where('city_id', $locationId)->paginate(9);
        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function locationCategorySearch($location, $locationId, $category, $category_id)
    {
        $category = Category::findOrFail($category_id);
        $location = Location::findOrFail($locationId);

        $posts = Post::where('status', 'ACTIVE')->where('city_id', $locationId)->where('category_id', $category_id)->paginate(9);
        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function localityCategorySearch($location, $locationId, $locality, $category, $category_id)
    {
        $category = Category::findOrFail($category_id);
        $location = Location::findOrFail($locationId);

        $posts = Post::where('status', 'ACTIVE')->where('category_id', $category_id)->where('locality', $locality)->paginate(9);
        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function localitySearch($location, $locationId, $locality)
    {
        $category = null;
        $location = Location::findOrFail($locationId);

        $posts = Post::where('status', 'ACTIVE')->where('locality', $locality)->paginate(9);
        return view('user.products', compact('posts', 'category', 'location'));
    }

}
