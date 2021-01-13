<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    protected $fillable = ([
        'name', 'slug', 'icon', 'parent_id', 'icon',
    ]);

    //this defines category have many posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
