<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Location;
use App\Models\Post;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{

    /**
     * @param SearchRequest $request
     * @return Post $posts
     */

    public function search(SearchRequest $request)
    {
        $query = $request->query('query');
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

    public function categorySearch($category, $category_id)
    {
        $category = Category::findOrFail($category_id, ['id', 'slug', 'name']);
        $location = null;
        $posts = $category->posts()
            ->with(['postImages', 'category' => function ($query) {
                $query->select('id', 'slug', 'name');
            }])
            ->active()->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);
        // $posts = Post::where('status', 'ACTIVE')->where('category_id', $category->id)->paginate(9);
        // $posts->load(['postImages', 'category']);
        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function LocationSearch($location, $locationId)
    {
        $category = null;
        $location = Location::findOrFail($locationId, ['id', 'slug', 'name']);
        $posts = $location->posts()->active()->paginate(9);
        // $posts = Post::where('status', 'ACTIVE')->where('city_id', $locationId)->paginate(9);
        if ($posts->isEmpty()) {
            $posts = Post::active()->postState($locationId)->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);
        }
        $posts->load(['category', 'postImages']);
        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function locationCategorySearch($location, $locationId, $category, $category_id)
    {
        $category = Category::findOrFail($category_id, ['id', 'slug', 'name']);
        $location = Location::findOrFail($locationId, ['id', 'slug', 'name']);

        // $posts = Post::active()->where('city_id', $locationId)->where('category_id', $category_id)->paginate(9);
        $posts = $location->posts()->active()->postCategory($category_id)->paginate(9);
        if ($posts->isEmpty()) {
            $posts = Post::active()->postState($locationId)->postCategory($category_id)->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);
        }
        $posts->load(['category', 'postImages']);
        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function localityCategorySearch($location, $locationId, $locality, $category, $category_id)
    {
        $category = Category::findOrFail($category_id, ['id', 'slug', 'name']);
        $location = Location::findOrFail($locationId, ['id', 'slug', 'name']);
        $locality = str_replace('_', ' ', $locality);

        // $posts = Post::active()->where('category_id', $category_id)->whereLocality($locality)->paginate(9);
        $posts = $location->posts()->active()->postCategory($category_id)->whereLocality($locality)->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);
        $posts->load(['category', 'postImages']);
        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function localitySearch($location, $locationId, $locality)
    {
        $category = null;
        $location = Location::findOrFail($locationId, ['id', 'slug', 'name']);
        $locality = str_replace('_', ' ', $locality);

        // $posts = Post::active()->where('city_id', $locationId)->where('locality', $locality)->paginate(9);
        $posts = $location->posts()->active()->whereLocality($locality)->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);
        $posts->load(['category', 'postImages']);
        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function ajaxLocation(Request $request)
    {
        $locations = [];

        if ($request->has('location')) {
            $search = $request->location;
            $locations = Location::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($locations);
    }
}
