<?php

namespace App\Http\Controllers\User;

use App\Events\PostMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\Post;
use App\Models\User;

class UserMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['authStore']);
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

        $message =  Message::create([
            'post_id' => $post->id,
            'user_id' => $post->user->id,
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
        ]);

        PostMessageEvent::dispatch($message);

        return redirect()->intended()->with('success', 'Message request sent successfully');
    }

    /**
     * Store message for a seller when the user is logged in
     *
     * @param User $user
     * @param Post $post
     */
    public function authStore($postId)
    {
        $user = User::current();
        $post = Post::findOrFail($postId);

        if ($post->user == $user) {
            return back()->with('info', 'You can\'t send message request to yourself');
        }

        $message =  Message::create([
            'post_id' => $post->id,
            'user_id' => $post->user->id,
            'name' => $user->name,
            'mobile' => $user->mobile,
            'email' => $user->email,
        ]);

        PostMessageEvent::dispatch($message);

        return redirect()->intended()->with('success', 'Message request sent successfully');
    }
}
