<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;

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

    public function categorySearch($id)
    {
        $category = Category::findOrFail($id);
        $posts = Post::where('status', 'ACTIVE')->where('category_id', $category->id)->paginate(9);

        return view('products', compact('posts'));
    }

    public function subCategorySearch($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $posts = Post::where('status', 'ACTIVE')->where('category_id', $sub_category->id)->paginate(9);

        return view('products', compact('posts'));
    }

    public function citySearch($city)
    {
        $posts = Post::where('status', 'ACTIVE')->where('city', $city)->paginate(9);

        return view('products', compact('posts'));
    }

    public function stateSearch($state)
    {
        $posts = Post::where('status', 'ACTIVE')->where('city', $state)->paginate(9);

        return view('products', compact('posts'));
    }

    public function cityLocalitySearch($city, $locality)
    {
        $posts = Post::where('status', 'ACTIVE')->where('city', $city)->where('locality', $locality)->paginate(9);

        return view('products', compact('posts'));
    }

    public function stateCategorySearch($state, $category_id)
    {
        $category = Category::findOrFail($category_id);

        $posts = Post::where('status', 'ACTIVE')->where('state', $state)->where('category_id', $category->id)->paginate(9);

        return view('products', compact('posts'));
    }

    public function cityCateogrySearch($city, $category_id)
    {
        $category = Category::findOrFail($category_id);

        $posts = Post::where('status', 'ACTIVE')->where('city', $city)->where('category_id', $category->id)->paginate(9);

        return view('products', compact('posts'));
    }

    public function stateSubCategorySearch($state, $sub_category_id)
    {
        $sub_category = SubCategory::findOrFail($sub_category_id);

        $posts = Post::where('status', 'ACTIVE')->where('state', $state)->where('category_id', $sub_category->id)->paginate(9);

        return view('products', compact('posts'));
    }

    public function citySubCategorySearch($city, $sub_category_id)
    {
        $sub_category = SubCategory::findOrFail($sub_category_id);

        $posts = Post::where('status', 'ACTIVE')->where('city', $city)->where('category_id', $sub_category->id)->paginate(9);

        return view('products', compact('posts'));
    }

    public function cityLocalityCategorySearch($city, $locality, $category_id)
    {
        $category = Category::findOrFail($category_id);

        $posts = Post::where('status', 'ACTIVE')->where('city', $city)->where('locality', $locality)->where('category_id', $category->id)->paginate(9);

        return view('products', compact('posts'));
    }
    public function cityLocalitySubCategorySearch($city, $locality, $sub_category_id)
    {
        $sub_category = SubCategory::findOrFail($sub_category_id);

        $posts = Post::where('status', 'ACTIVE')->where('city', $city)->where('locality', $locality)->where('category_id', $sub_category->id)->paginate(9);

        return view('products', compact('posts'));
    }
}
