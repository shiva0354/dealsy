<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'mobile', 'post_id', 'user_id',
    ];

    /**
     * Defining message belongs to some user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Defining message belongs to some post
    */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
