<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function create(UserRegisterRequest $request)
    {
        $input = $request->input();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        Auth::login($user);
        return redirect()->intended()->with('success', 'Account created successfully');
    }
}
