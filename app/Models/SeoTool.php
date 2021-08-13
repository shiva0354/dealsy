<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoTool extends Model
{
    use HasFactory;

    protected $fillable= [
        'url',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_url',
        'twitter_title',
        'twitter_description',
        'cannonical_url'
    ];
}
