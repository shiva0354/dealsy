<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class AdminForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Showing forgot password form
     */
    public function showLinkRequestForm()
    {
        return view('vendor.adminlte.auth.passwords.email');
    }

    /**
     * Defining broker to use for password reset
     */
    public function broker()
    {
        return Password::broker('admins');
    }
}
