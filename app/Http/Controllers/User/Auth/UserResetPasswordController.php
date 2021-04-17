<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class UserResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function __construct()
    {
        $this->middleware('auth')->only(['showForm', 'changePassword']);
        $this->middleware('guest');
    }

    protected $redirectTo = '/';

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('user.auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function showForm()
    {
        return view('user.auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());
        $user = $this->guard()->user();
        $password = $request->input('password');
        $this->resetPassword($user, $password);
        return redirect()->route('user.dashboard');
    }
}
