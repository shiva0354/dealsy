<?php

namespace App\Models;

use App\Http\Controllers\Admin\AuthBackend\VerifiesEmails;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, VerifiesEmails,Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'role',
        'remember_token',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
