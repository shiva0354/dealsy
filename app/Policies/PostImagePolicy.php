<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostImage  $postImage
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function post_image(User $user, Post $post, PostImage $image)
    {
        return ($user->id === $post->user_id && $post->id === $image->post_id) ? Response::allow() : Response::deny('You do not own this post.');
    }
}
