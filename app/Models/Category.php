<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    protected $fillable = ([
        'category', 'slug',
    ]);

    //this defines categories can have many sub categories
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    //this defines category have many posts
    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
