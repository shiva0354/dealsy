<?php
namespace App\Library;

use App\Traits\AuthGuard;

/**
 *
 */
trait AdminAuthGuard
{
    use AuthGuard;

    public $guard = 'admin';
}
