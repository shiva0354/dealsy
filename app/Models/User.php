<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

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

    public static function current()
    {
        $user = Auth::user();
        if ($user instanceof User) {
            return $user;
        }

        throw new UnauthorizedException();
    }

    //this defines user can have many posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //this defines user can have many saved posts
    public function savedposts()
    {
        return $this->belongsToMany(Post::class, 'saved_posts', 'user_id', 'post_id');
    }
}
