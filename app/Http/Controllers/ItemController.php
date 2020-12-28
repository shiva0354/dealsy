<?php

namespace App\Http\Controllers;

use App\Models\Post;

class ItemController extends Controller
{
    public function showItem($id)
    {
        $item = Post::findOrFail($id);
        return view('item', compact('item'));
    }
}
