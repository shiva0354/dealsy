<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Location;
use App\Models\Post;
use Illuminate\Http\Request;

class UserAjaxController extends Controller
{
    /**
     * returning categories
     * @param Illuminate\Http\Request $request
     */
    public function ajaxCategory(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::selectRaw('`id`, `name` as `text`')->where('name', 'like', '%' . $search . '%')->get();
        return response()->json($categories);
    }

    /**
     * returning locations
     * @param Illuminate\Http\Request $request
     */
    public function ajaxcities(Request $request)
    {
        $search = $request->input('search');

        $cities = Location::with('state')->whereNotNull('parent_id')->where('name', 'like', '%' . $search . '%')->get(['id', 'name', 'parent_id']);

        $response = array();
        foreach ($cities as $city) {
            $response[] = array(
                "id" => $city->id,
                "text" => $city->name . "," . $city->state->name
            );
        }

        return response()->json($response);
    }


    /**
     * returning titles
     * @param Illuminate\Http\Request $request
     */
    public function ajaxPostsTitle(Request $request)
    {
        $search = $request->input('search');
        $titles = Post::selectRaw('distinct `title` as text')->where('title', 'like', '%' . $search . '%')->take(1000)->get();
        return response()->json($titles);
    }

    /**
     * @param int $stateId
     * @return Location $cities
     */
    public function cities($stateId)
    {
        $state = Location::findOrFail($stateId);
        $cities = $state->cities;
        return $cities;
    }

    /**
     * @param int $id
     * @return Category $categories
     */
    public function categories($id)
    {
        $category = Category::findOrFail($id);
        $categories = $category->subCategories;
        return $categories;
    }
}
