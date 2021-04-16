<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('user.auth.signup');
    }

    public function register(UserRegisterRequest $request)
    {
        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);

        event(new Registered($user = User::create($input)));
        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return redirect()->intended()->with('success', 'Account created successfully');
    }
}
