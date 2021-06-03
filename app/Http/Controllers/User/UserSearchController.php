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
        $title = $request->query('query');
        $category = $request->query('category');
        $location = $request->query('location');

        $posts = Post::with(['firstImage', 'category' => function ($query) {
            $query->select('id', 'slug', 'name');
        }])->active()
            ->when($title, function ($query, $title) {
                return $query->where('title', 'LIKE', $query);
            })
            ->when($category, function ($query, $category) {
                return $query->postCategory($category);
            })
            ->when($location, function ($query, $location) {
                return $query->where('city_id', $location);
            })
            ->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);

        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function categorySearch($category, $category_id)
    {
        $category = Category::findOrFail($category_id, ['id', 'slug', 'name']);
        $location = null;
        $posts = $category->posts()
            ->with(['firstImage', 'category' => function ($query) {
                $query->select('id', 'slug', 'name');
            }])
            ->active()
            ->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);

        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function LocationSearch($location, $locationId)
    {
        $category = null;
        $location = Location::findOrFail($locationId, ['id', 'slug', 'name']);
        $posts = $location->posts()
            ->with(['firstImage', 'category' => function ($query) {
                $query->select('id', 'slug', 'name');
            }])->active()
            ->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);

        if ($posts->isEmpty()) {
            $posts = Post::with(['firstImage', 'category' => function ($query) {
                $query->select('id', 'slug', 'name');
            }])->active()
                ->postState($locationId)
                ->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);
        }

        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function locationCategorySearch($location, $locationId, $category, $category_id)
    {
        $category = Category::findOrFail($category_id, ['id', 'slug', 'name']);
        $location = Location::findOrFail($locationId, ['id', 'slug', 'name']);

        $posts = $location->posts()
            ->with(['firstImage', 'category' => function ($query) {
                $query->select('id', 'slug', 'name');
            }])->active()
            ->postCategory($category_id)
            ->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);

        if ($posts->isEmpty()) {
            $posts = Post::with(['firstImage', 'category' => function ($query) {
                $query->select('id', 'slug', 'name');
            }])->active()
                ->postState($locationId)
                ->postCategory($category_id)
                ->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);
        }

        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function localityCategorySearch($location, $locationId, $locality, $category, $category_id)
    {
        $category = Category::findOrFail($category_id, ['id', 'slug', 'name']);
        $location = Location::findOrFail($locationId, ['id', 'slug', 'name']);
        $locality = str_replace('_', ' ', $locality);

        // $posts = Post::active()->where('category_id', $category_id)->whereLocality($locality)->paginate(9);
        $posts = $location->posts()
            ->with(['firstImage', 'category' => function ($query) {
                $query->select('id', 'slug', 'name');
            }])->active()
            ->postCategory($category_id)
            ->whereLocality($locality)
            ->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);

        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function localitySearch($location, $locationId, $locality)
    {
        $category = null;
        $location = Location::findOrFail($locationId, ['id', 'slug', 'name']);
        $locality = str_replace('_', ' ', $locality);

        $posts = $location->posts()
            ->with(['firstImage', 'category' => function ($query) {
                $query->select('id', 'slug', 'name');
            }])->active()
            ->whereLocality($locality)
            ->paginate(9, ['id', 'category_id', 'title', 'price', 'created_at']);

        return view('user.products', compact('posts', 'category', 'location'));
    }

    public function ajaxCategory()
    {
        $categories = Category::get(['id', 'name']);
        return json_encode($categories);
    }

    public function ajaxcities()
    {
        $cities = Location::wherNotNull('parent_id')->get(['id', 'name']);
        return json_encode($cities);
    }
}
