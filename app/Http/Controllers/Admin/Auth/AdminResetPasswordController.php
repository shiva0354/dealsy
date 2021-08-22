<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AdminResetPasswordController extends Controller
{
    use ResetsPasswords;

    // public function __construct()
    // {
    //     $this->middleware('auth:admin')->only(['showChangePasswordForm', 'changePassword']);
    // }

    protected $redirectTo = '/admin';

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('vendor.adminlte.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return Password::broker('admins');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showChangePasswordForm()
    {
        return view('admin.admin-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|password',
            'password' => 'required|string|min:8|max:255|confirmed',
        ]);
        $user = $this->guard()->user();
        $password = $request->input('password');
        $this->resetPassword($user, $password);
        return redirect()->route('admin.home');
    }
}
