<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\SocialAuth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserLoginController extends Controller
{
    use AuthenticatesUsers, SocialAuth;

    public function __construct()
    {
        $this->middleware('auth')->only('logout');
        $this->middleware('guest')->except('logout');
    }
    protected $providers = [
        'facebook', 'google',
    ];

    public function showLoginForm()
    {
        return view('user.auth.login');
    }
/**
 * @param Laravel\Socialite\Contracts\User $socialiteUser
 * $provider
 */
    protected function createUserOnLogin($socialiteUser, $provider)
    {
       $user = User::create([
            'name' => $socialiteUser->getName(),
            'avatar' => $socialiteUser->getAvatar(),
            'email' => $socialiteUser->getEmail(),
            'provider' => $provider,
            'provider_id' => $socialiteUser->getId(),
            'access_token' => $socialiteUser->token,
        ]);
        return $user;
    }

    protected function getUserByEmail($email)
    {
        return User::whereEmail($email)->first();
    }
}
