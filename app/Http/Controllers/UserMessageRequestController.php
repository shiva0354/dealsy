<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\MessageRequest as ModelsMessageRequest;
use App\Models\Post;

class UserMessageRequestController extends Controller
{
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
        $user = $post->user;

        ModelsMessageRequest::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'message' => $request->input('message'),
        ]);
        //genrate event
        return redirect()->intended()->with('success', 'Message request sent successfully');
    }
}
