<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ([
        'image', 'post_id',
    ]);

    /**
     * this defines image belongs to a post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
