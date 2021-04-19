<?php

namespace App\Policies;

use App\Models\PostVideo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostVideoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostVideo  $postVideo
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function view(User $user,Post $post, PostVideo $postVideo)
    {
        return ($user->id === $post->user_id && $post->id ===$postVideo->post_id) ? Response::allow() : Response::deny('This video doesn\'t belong to this Post.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @param  \App\Models\PostVideo  $postVideo
     * @return mixed
     */
    public function delete(User $user, Post $post, PostVideo $postVideo)
    {
        return ($user->id === $post->user_id && $post->id ===$postVideo->post_id) ? Response::allow() : Response::deny('This video doesn\'t belong to this Post.');
    }
}
