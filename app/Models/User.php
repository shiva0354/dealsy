<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ([
        'name',
        'email',
        'password',
        'avatar',
        'provider',
        'provider_id',
        'remember_token',
    ]);

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //this defines user can have many posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //this defines user can have many saved posts
    public function savedposts()
    {
        return $this->hasMany(SavedPost::class);
    }
}
