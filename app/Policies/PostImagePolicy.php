<?php

namespace App\Policies;

use App\Models\PostImage;
use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostImage  $postImage
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post, PostImage $postImage)
    {
        return ($user->id === $post->user_id && $post->id ===$postImage->post_id) ? Response::allow() : Response::deny('You do not own this post.');
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostImage  $postImage
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post, PostImage $postImage)
    {
        return ($user->id === $post->user_id && $post->id ===$postImage->post_id) ? Response::allow() : Response::deny('You do not own this post.');
    }
}
