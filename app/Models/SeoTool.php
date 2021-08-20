<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'twitter_title',
        'twitter_description',
    ];

    /**
     * finding seo detail by url
     * @param string $url
     */
    public static function findByUrl(string $url)
    {
        return self::where('url', $url)->first([
            'url',
            'meta_title',
            'meta_description',
            'og_title',
            'og_description',
            'twitter_title',
            'twitter_description',
        ]);
    }
}
