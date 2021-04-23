<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Location;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class UserPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        $states = $locations->whereNull('parent_id');
        $cities = $locations->whereNotNull('parent_id');
        $post = null;
        return view('user.ad-listing', compact('categories', 'states', 'cities', 'post'));
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
        $user = User::current();
        $post = Post::findOrFail($id);
        $response = Gate::inspect('post', $post);

        if (!$response->allowed()) {
            return redirect()->back()->with('error', $response->message());
        }

        $post->load(['category', 'postImages', 'PostVideo']);
        $categories = Category::all();
        $locations = Location::all();
        $states = $locations->whereNull('parent_id');
        $cities = $locations->whereNotNull('parent_id');
        return view('user.ad-listing', compact('categories', 'states', 'cities', 'post'));
    }

    public function store(PostRequest $request)
    {
        //create and store the newly ads
        $user = User::current();
        try {
            $images = $this->saveImage($request);
            $input = $this->getInput($request, $user->id);
            $post = Post::create($input);

            if ($images) {
                foreach ($images as $image) {
                    PostImage::create(['post_id' => $post->id, 'image' => $image]);
                }
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('home')->with('success', 'Ad posted successfully');
    }

    public function update(PostRequest $request, $id)
    {
        //update the posting of ads
        $user = User::current();
        $post = Post::findOrFail($id);
        $response = Gate::inspect('postPermission', $post);

        if (!$response->allowed()) {
            return redirect()->back()->with('error', $response->message());
        }

        try {
            $images = $this->saveImage($request);
            $input = $this->getInput($request, $user->id);

            $post->update($input);

            if ($images) {
                foreach ($images as $image) {
                    PostImage::create(['post_id' => $post->id, 'image' => $image]);
                }
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('home')->with('success', 'Ad updated successfully');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $response = Gate::inspect('postPermission', $post);

        if (!$response->allowed()) {
            return redirect()->back()->with('error', $response->message());
        }
        $post->delete();
        return redirect()->intended()->with('success', 'Post Deleted Successfully');
    }

    private function getInput($request, $userId)
    {
        $input = $request->only([
            'category_id',
            'title',
            'detail',
            'ad_type',
            'expected_price',
            'is_price_negotiable',
            'locality',
            'location_id', //city
            'state_id',
        ]);

        $input['user_id'] = $userId;
        return $input;
    }

    private function saveImage($request)
    {
        $images[] = '';

        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {
                $name = Str::random(60) . '.' . $file->extension();
                $file->move(public_path('upload/posts/'), $name);
                $images[] = $name;
            }
        }
        return $images;
    }
}
