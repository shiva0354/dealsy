<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, Throwable $e)
    {
        // if (!$request->expectsJson()) {
        //     $e = $this->prepareException($e);
        //     // $debug = config('app.debug') ? $e->getTraceAsString() : null;

        //     if ($e instanceof UnauthorizedException) {
        //         return $e->getMessage();
        //     }
        // }

        return parent::render($request, $e);
    }
}
