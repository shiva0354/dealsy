<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostVideo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'post_videos';

    protected $fillable = ([
        'video', 'post_id',
    ]);

    // this defines video belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
