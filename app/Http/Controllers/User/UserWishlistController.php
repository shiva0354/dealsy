<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserWishlistController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function wishlist($id)
    {
        if (!Auth::check()) {
            return json_encode("unauthenticated");
        }

        $user = User::current();
        $post = Post::findOrFail($id);

        if ($user->isPostSavedAlready($post, false)) {
            $user->savedposts()->detach($post);
            return json_encode(['type' => 'detach', 'message' => 'Post removed from your favourite successfully.']);
        }

        $user->savedposts()->attach($post);
        return json_encode(['type' => 'attach', 'message' => 'Post saved to your favourite successfully.']);
    }
}
