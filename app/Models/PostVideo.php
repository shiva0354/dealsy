<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostVideo extends Model
{
    use HasFactory;
    protected $table = 'post_videos';

    protected $fillable = [
        'video', 'post_id',
    ];
}
