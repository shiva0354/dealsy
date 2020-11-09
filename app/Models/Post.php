<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'sub_category_id',
        'post_title',
        'post_detail',
        'is_active',
        'is_seller',
        'is_individual',
        'expected_price',
        'is_price_negotiable',
        'last_renewed_on',
        'locality',
        'city',
        'state',
    ];
    //defining one to many relationship with post_images table
    public function image()
    {
        return $this->hasMany(PostImage::class);
    }
    //defining one to one relationship with post_videos table
    public function video()
    {
        return $this->hasOne(PostVideo::class);
    }
}
