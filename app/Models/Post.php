<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'detail',
        'status',
        'price',
        'last_renewed_on',
        'locality',
        'city',
        'state',
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

    //this defines post belong to category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(Location::class, 'city');
    }

    public function state()
    {
        return $this->belongsTo(Location::class, 'state');
    }

    public function postLocation()
    {
        return ($this->locality . "," . $this->city->location . "," . $this->state->location);
    }

    public function saveImage(string $image)
    {
        PostImage::create(['post_id' => $this->id, 'image' => $image]);
    }
}
