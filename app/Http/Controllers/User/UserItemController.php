<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;

class UserItemController extends Controller
{

    /**
     * @param Post $item
     * @param int $postId
     * @param string $title
     *
     * return item
     */
    public function showItem($postId, $title)
    {
        $item = Post::findOrFail($postId);
        return view('item', compact('item'));
    }
}
