<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;
    protected $table='post_images';

    protected $fillable=[
        'image','post_id',
    ];
    //defining many to one relationship with posts table
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
