<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Don't forget to implement database transaction while adding and updating product
// implement auto approve ads after new ads get submitted by the user
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view('products', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ad-listing');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user()->id;
        //create and store the newly ads
        $request->validate([
            'ad_title' => 'string|required|max:80',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //uodate the posting of ads
    }

    /**
     * Remove the specified resource from storage. softdelete
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
