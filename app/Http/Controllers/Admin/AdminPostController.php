<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\AdminAuthGuard;
use App\Models\Category;
use App\Models\Location;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    use AdminAuthGuard;

    public function index(Request $request)
    {
        $status = $request->query('status');
        $status ? $status = $status : $status = "PENDING";
        $category = $request->query('category');
        $location = $request->query('location');
        $locality = $request->query('locality');

        $posts = Post::whereStatus($status)
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($location, function ($query, $location) {
                return $query->where('city_id', $location);
            })
            ->when($locality, function ($query, $locality) {
                return $query->where('locality', $locality);
            })
            ->paginate(10);
        $posts->load(['user', 'postImages', 'category']);
        $categories = Category::all();
        $locations = Location::whereNotNull('parent_id')->get();
        return view('admin.posts-index', compact('posts', 'categories', 'locations'));
    }

    /**
     * @param Post $post
     */
    public function changeStatus($postId, $status)
    {
        $array = ['SOLD', 'ACTIVE', 'REJECTED'];

        if (!in_array($status, $array)) {
            return redirect()->back()->with('error', 'Wrong status sent');
        }

        $post = Post::findOrFail($postId);
        $post->setStatus($status);

        return redirect()->back()->with('success', "Stattus set to $status successfully");
    }

    public function postDetail($postId)
    {
        $post = Post::findOrFail($postId);
        $post->load(['user', 'postImages', 'category']);
        return view('admin.post-show', compact('post'));
    }

    // public function getByCategory(string $category_slug, $status = null)
    // {
    //     if ($status) {
    //         $status = $status;
    //     } else {
    //         $status = "PENDING";
    //     }

    //     $category = Category::findBySlug($category_slug);
    //     $posts = $category->posts()->status($status)->paginate(10);
    //     $posts->load(['user', 'postImages']);
    //     return view('admin.posts-index', compact('posts'));
    // }

    // public function getByStatus(string $status)
    // {
    //     $posts = Post::status($status)->paginate(10);
    //     return view('admin.posts-index', compact('posts'));
    // }
}
