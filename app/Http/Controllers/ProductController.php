<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Don't forget to implement database transaction while adding and updating product
// implement auto approve ads after new ads get submitted by the user
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);

        return view('products', compact('posts'));
    }

    public function create()
    {
        return view('ad-listing');
    }

    public function store(PostRequest $request)
    {
        $user = auth()->user()->id;
        //create and store the newly ads
        $request->validate([
            'ad_title' => 'string|required|max:80',
        ]);
    }

    public function show($id)
    {
        // show the particular ad
        $post = Post::findOrFail($id);
        return view('item', compact('post'));
    }
    //show ad edit form view
    public function edit($id)
    {
        return view('item');
    }

    public function update(PostRequest $request, $id)
    {
        //uodate the posting of ads
    }

    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('warning', 'Please Login!');
        } else {
            DB::beginTransaction();
            try {
                $post = Post::findOrFail($id); //user can only delete their own post
                $post->destroy();
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->intended()->with('error', $e->getMessage());
            }
            DB::commit();
            return redirect()->intended()->with('success', 'Post Deleted Successfully');
        }
    }
}
