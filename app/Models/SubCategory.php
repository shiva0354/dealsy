<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sub_categories';

    protected $fillable = ([
        'name', 'category_id', 'slug',
    ]);

    //this defines subcategory belongs to some category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // this defines sub categoris can have many posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
