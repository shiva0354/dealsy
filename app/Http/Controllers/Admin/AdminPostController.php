<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\AdminAuthGuard;
use App\Models\Post;

class AdminPostController extends Controller
{
    use AdminAuthGuard;

    public function index()
    {
        $posts = Post::whereStatus('PENDING')->paginate(10);
        $posts->load(['user', 'postImages', 'category']);
        return view('admin.posts-index', compact('posts'));
    }

    /**
     * @param Post $post
     */
    public function makePostActive($postId, $status)
    {
        $array = ['SOLD', 'ACTIVE', 'REJECTED'];

        if (!in_array($status, $array)) {
            return redirect()->back()->with('error', 'Wron status sent');
        }

        $post = Post::findOrFail($postId);
        $post->setStatus($status);

        return redirect()->back()->with('success', "Stattus set to $status successfully");
    }
}
