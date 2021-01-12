<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

// Don't forget to implement database transaction while adding and updating product
// implement auto approve ads after new ads get submitted by the user
class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    const STATES = ['Andaman and Nicobar Islands', 'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chandigarh', 'Chhattisgarh', 'Dadra Nagar Haveli', 'Daman & Diu', 'Delhi', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jammu and Kashmir', 'Jharkhand', 'Karnataka', 'Kerala', 'Ladakh', 'Lakshadweep', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Puducherry', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal'];

    public function create()
    {
        // $states = $this->dd('State', self::STATES);
        return view('ad-listing');
    }

    public function store(PostRequest $request)
    {
        //create and store the newly ads
        $user = User::current();
        try {
            $images[] = '';

            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $file) {
                    $name = Str::random(60) . '.' . $file->extension();
                    $file->move(public_path('upload/posts/') , $name);
                    $images[] = $name;
                }
            }

            $post = Post::create([
                'user_id' => $user->id,
                'post_title' => $request->input('post_title'),
                'post_detail' => $request->input('post_detail'),
                'category_id' => $request->input('category_id'),
                'sub_category_id' => $request->input('sub_category_id'),
                'ad_type' => $request->input('ad_type'),
                'expected_price' => $request->input('expected_price'),
                'is_price_negotiable' => $request->input('is_negotiable'),
                'locality' => $request->input('locality'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'images'=>json_encode($images),
            ]);

            // if ($images) {
            //     foreach ($images as $image) {
            //         PostImage::create(['post_id' => $post->id, 'image' => $image]);
            //     }
            // }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('home')->with('success', 'Ad posted successfully');
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
        User::current();
        $countries = $this->ddArray('Country', self::STATES);
        $post = Post::findOrFail($id);
        return view('item', compact('post', 'countries'));
    }

    public function update(PostRequest $request, $id)
    {
        //uodate the posting of ads
        $user = User::current();
    }

    public function destroy($id)
    {
        User::current();

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
