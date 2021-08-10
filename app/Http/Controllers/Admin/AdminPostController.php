<?php

namespace App\Http\Controllers\Admin;

use App\Events\PostEvent;
use App\Http\Controllers\Controller;
use App\Library\AdminAuthGuard;
use App\Models\Category;
use App\Models\Location;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    use AdminAuthGuard;

    /**
     * Returns the list of the posts
     * By default return only pending posts
     * @param string $status
     * @param int $category, $location
     */

    public function index(Request $request)
    {
        $status = $request->query('status');
        $status = $status  ? $status : "PENDING";
        $category = $request->query('category');
        $location = $request->query('location');
        $locality = strtolower($request->query('locality'));

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
            ->paginate(20,['id','title','category_id','city_id','user_id','status','created_at']);

        $posts->load(['user' => function ($q) {
            return $q->select('id', 'name');
        }, 'category' => function ($q) {
            return $q->select('id', 'name');
        }]);
        $categories = Category::get(['name', 'id']);
        $locations = Location::whereNotNull('parent_id')->get(['name', 'id']);
        return view('admin.posts-index', compact('posts', 'categories', 'locations'));
    }

    /**
     * Changing status of the post
     * @param Post $post
     */
    public function changeStatus($postId, $status)
    {
        $status = strtoupper($status);
        $array = ['SOLD', 'ACTIVE', 'REJECTED'];

        if (!in_array($status, $array)) {
            return redirect()->back()->with('error', 'Wrong status sent');
        }

        $post = Post::findOrFail($postId);
        $post->setStatus($status);
        PostEvent::dispatch($status, $post);

        return redirect()->route('admin.posts.index')->with('success', "Status set to '$status' successfully");
    }

    /**
     * Displaying particular post with their details
     * @param Post $post
     */
    public function postDetail($postId)
    {
        $post = Post::findOrFail($postId);
        $post->load(['user', 'postImages', 'category']);
        return view('admin.post-show', compact('post'));
    }
}
