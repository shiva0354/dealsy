<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    /**
     * Displaying key datas on the dashboard
     *
     * Using cache to serve the content faster
     */
    public function index()
    {
        $data = cache()->remember('admin-home', 60 * 60, function () {

            return [
                'user_count' => User::whereDate('created_at', now()->today())->count('id'),
                'post_count' => Post::whereDate('created_at', now()->today())->count('id'),
                'message_count' => Message::whereDate('created_at', now()->today())->count('id'),
                'sold_count' => Post::whereStatus('SOLD')->whereDate('updated_at', now()->today())->count('id'),
                'images_count' => PostImage::whereDate('created_at', now()->today())->count('id'),
                'inventory_count' => Post::active()->count('id'),
                'total_money_saved' => Post::withTrashed()->sum('price'),
                'saved_count' => DB::table('saved_posts')->count('id'),
            ];
        });
        return view('admin.home', ['data' => $data]);
    }
}
