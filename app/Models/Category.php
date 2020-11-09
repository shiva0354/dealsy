<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'category_name',
    ];
//defining one to many relationship with sub categories
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
