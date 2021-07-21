<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'parent_id',
    ];

    /**
     * Defining location has many cities
     */
    public function cities()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

    /**
     *
     */
    public function state()
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }

    /**
     * Defining location has many posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'city_id');
    }
}
