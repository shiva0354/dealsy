<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

/**
 *
 */
trait AuthGuard
{
    public function __construct()
    {
        $guard = $this->guard ?? null;
        $this->middleware($guard ? "auth:$guard" : 'auth');

        if (method_exists($this, "__init")) {
            $this->__init();
        }
    }

    protected function guard()
    {
        return Auth::guard($this->guard ?? null);
    }
}
