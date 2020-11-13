<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Auth\Events\Validated;
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
        //create and store the newly ads
        $request->validate([
            'ad_title'=>'string|required|max:80'
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with([
                'message' => 'Please Login!',
            ]);
        } else {
            DB::beginTransaction();
            try {
                Post::where('post_id', $id, '&', 'user_id', auth()->user()->id) //user can only delete their own post
                    ->destroy();
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->intended()->with([
                    'message' => $e,
                ]);
            }
            DB::commit();
            return redirect()->intended()->with([
                'message' => 'Post Deleted Successfully',
            ]);
        }
    }
}
