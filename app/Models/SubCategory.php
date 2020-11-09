<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    protected $fillable = [
        'sub_category', 'category_id',
    ];
//defining that it ha many to one relationship with categories table
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
