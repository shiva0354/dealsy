<?php

use Illuminate\Support\Facades\Auth;

function auth_guard()
{
    if (Auth::guard('admin')->check()) {
        return 'admin';
    } else {
        return 'web';
    }
}
