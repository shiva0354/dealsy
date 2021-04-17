<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserChangePasswordController extends Controller
{
    use ResetsPasswords;

    public function __construct()
    {
        $this->middleware('auth');
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
