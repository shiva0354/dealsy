<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    // public function __construct()
    // {
    //     $this->middleware('auth:admin')->only('logout');
    //     $this->middleware('guest:admin')->except('logout');
    // }

    protected $redirectTo = '/admin';

    public function showLoginForm()
    {
        return view('vendor.adminlte.auth.login');
    }

    /**
     * Oveririding the logout method so that admin can get redirected to admin login page
     */
    public function logout(Request $request,string $message = null)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return redirect()->route('admin.login')->with('message',$message);
    }

    /**
     * Overriding the guard function so that it can use our custom admin guard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if (!$user->enabled) {
            return $this->logout($request,'Your account is not active');
        }
    }
}
