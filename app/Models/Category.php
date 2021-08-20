<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ([
        'name', 'slug', 'icon', 'parent_id'
    ]);

    /**
     * Defining relation that category has many posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Defining that category has many subcategories that resides in the same table
     */
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Defining that category has a parent
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Finding category by slug
     */
    public static function findBySlug(string $slug)
    {
        return Category::firstWhere('slug', $slug);
    }
}
