<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\MessageRequest as ModelsMessageRequest;
use App\Models\Post;
use App\Models\User;

class UserMessageRequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['authStore']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request, $postId)
    {
        $post = Post::findOrFail($postId);

        ModelsMessageRequest::create([
            'post_id' => $post->id,
            'user_id' => $post->user->id,
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
        ]);
        //genrate event
        return redirect()->intended()->with('success', 'Message request sent successfully');
    }

    public function authStore($postId)
    {
        $user = User::current();
        $post = Post::findOrFail($postId);

        if ($post->user == $user) {
            return redirect()->back()->with('info', 'You can\'t send message request to yourself');
        }

        ModelsMessageRequest::create([
            'post_id' => $post->id,
            'user_id' => $post->user->id,
            'name' => $user->name,
            'mobile' => $user->mobile,
            'email' => $user->email,
        ]);

        return redirect()->intended()->with('success', 'Message request sent successfully');
    }
}
