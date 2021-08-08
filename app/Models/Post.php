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
        'city_id',
        'state_id',
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
        return $this->belongsTo(Location::class, 'city_id');
    }

    public function state()
    {
        return $this->belongsTo(Location::class, 'state_id');
    }

    public function postLocation()
    {
        return ($this->locality . "," . $this->city->name . "," . $this->state->name);
    }

    public function saveImage(string $image)
    {
        PostImage::create(['post_id' => $this->id, 'image' => $image]);
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
        $this->save();
    }

    /**
     * Defining scope for finding active post
     */
    public function scopeActive($query)
    {
        return $query->whereStatus('ACTIVE');
    }

    /**
     * Defining scope for finding post by category
     */
    public function scopePostCategory($query, $category_id)
    {
        return $query->where('category_id', $category_id);
    }

    /**
     * Defining scope for finding post by state
     */
    public function scopePostState($query, $state_id)
    {
        return $query->where('state_id', $state_id);
    }

    /**
     * Defining scope for finding post by state
     */
    public function scopePostCity($query, $city_id)
    {
        return $query->where('city_id', $city_id);
    }

    /**
     * retrieving first image of the post from post image table
     */
    public function firstImage()
    {
        return $this->hasOne(PostImage::class);
    }
}
