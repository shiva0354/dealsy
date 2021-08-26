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

class UserPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'userPosts']);
    }
    /**
     * showing view page for ad listing
     * @param Category $categories
     * @param Location $states
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        $states = Location::whereNull('parent_id')->get();
        $post = null;
        return view('user.ad-listing', compact('categories', 'states', 'post'));
    }

    /**
     * @param int $id
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->load(['category', 'postImages', 'city', 'state']);
        return view('user.item', compact('post'));
    }
    /**
     * Displaying edit form for post
     * @param int $id
     * @param User $user
     * @param Post $post
     * @param Category $categories
     * @param Location $states
     * @return \Illuminate\Http\Response $response
     */
    public function edit($id)
    {
        $user = User::current();
        $post = Post::findOrFail($id);

        $response = Gate::inspect('post', $post);
        if (!$response->allowed()) return back()->with('error', $response->message());

        if ($post->status == 'SOLD') return back()->with('info', 'Sold ad cannot be updated');

        $post->load(['category', 'postImages']);
        $categories = Category::all();
        $states = Location::whereNull('parent_id')->get();
        return view('user.ad-listing', compact('categories', 'states', 'post'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @param Post $post
     * @return \Illuminate\Http\Response $response
     */
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
                    $post->saveImage($image);
                }
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('home')->with('success', 'Ad posted successfully');
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @param User $user
     * @param Gate $response
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        //update the posting of ads
        $user = User::current();
        $post = Post::findOrFail($id);

        $response = Gate::inspect('post', $post);
        if (!$response->allowed()) return back()->with('error', $response->message());

        if ($post->status == 'SOLD') return back()->with('info', 'Sold ad cannot be updated');

        try {
            $images = $this->saveImage($request);
            $input = $this->getInput($request, $user->id);

            $post->update($input);

            if ($images) {
                foreach ($images as $image) {
                    $post->saveImage($image);
                }
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('home')->with('success', 'Ad updated successfully');
    }

    /**
     * @param int $id
     * @param Gate $response
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $response = Gate::inspect('post', $post);
        if (!$response->allowed()) return back()->with('error', $response->message());

        $post->delete();
        return back()->with('success', 'Post Deleted Successfully');
    }

    private function getInput($request, $userId)
    {
        $category = $request->filled('sub_category') ? $request->input('sub_category') : $request->input('category');

        $input = $request->only([
            'title',
            'detail',
            'price',
            'locality',
            'city_id',
            'state_id',
        ]);

        $input['user_id'] = $userId;
        $input['category_id'] = $category;
        return $input;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Arr $images
     */
    private function saveImage($request)
    {
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('uploads/posts/', 'public');
                $images[] = 'storage/' . $path;
            }
        }
        return $images;
    }

    /**
     * Deleting image  of a posts
     * @param Post $post
     * @param int $imageId
     * @param PostImage $image
     * @param Gate $response
     * @return mixed
     */
    public function deleteImage(Post $post, int $imageId)
    {
        $image = PostImage::findOrFail($imageId);

        $response = Gate::inspect('post', $post);
        if (!$response->allowed()) return response()->json($response->message());

        if (!$post->id === $image->post_id) return response()->json('Image doesn\'t belongs to this post.');

        $image->delete();
        return response()->json('Image deleted successfully.');
    }

    /**
     * Display posts by a particular user
     * @param int $userId
     * @param User $user
     * @param Post $posts
     * @return mixed
     */
    public function userPosts($userId)
    {
        $user = User::findOrFail($userId);
        $posts = $user->posts()->whereStatus('ACTIVE')->paginate(9);
        $posts->load(['category', 'postImages', 'city', 'state']);
        return view('user.user-products', compact('posts', 'user'));
    }
}
