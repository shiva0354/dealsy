<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    public $timestamps = false;
    protected $fillable = [
        'sub_category', 'category_id', 'sub_category_slug',
    ];
}
