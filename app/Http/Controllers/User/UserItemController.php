<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;

class UserItemController extends Controller
{
    public function showItem($id, $title)
    {
        $item = Post::findOrFail($id);
        return view('item', compact('item'));
    }
}
