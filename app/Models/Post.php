<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'detail',
        'status',
        'ad_type',
        'expected_price',
        'is_price_negotiable',
        'last_renewed_on',
        'locality',
        'location_id', //city
        'state_id',
    ];

    protected $visible = [
        'category_id',
        'title',
        'detail',
        'status',
        'ad_type',
        'expected_price',
        'is_price_negotiable',
        'locality',
        'location_id', //city
        'state_id',
        'created_at' => 'date',
    ];

    //castiing data type
    protected $casts = ([
        'last_renewed_on' => 'datetime',
    ]);

    //this defines that post belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // defines post can have multiple images
    public function postImages()
    {
        return $this->hasMany(PostImage::class);
    }

    //defines post can have one video
    public function postVideo()
    {
        return $this->hasOne(PostVideo::class);
    }

    //this defines post belong to category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function findUserOrFail($userId)
    {
        $user = User::findOrFail($userId);

        if ($user->id != $this->user_id) {
            throw new ModelNotFoundException("Error Processing Request");
        }
        return $user;
    }

}
