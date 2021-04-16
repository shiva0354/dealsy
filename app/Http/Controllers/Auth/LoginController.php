<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth')->only('logout');
    //     $this->middleware('guest:user')->except('logout');
    // }
    // protected $providers = [
    //     'github', 'facebook', 'google', 'twitter',
    // ];
    //show login page
    public function index()
    {
        return view('auth.login');
    }
    //login with email
    public function emailLogin(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if (Auth::attempt($validateData)) {
            return redirect()->intended();
        }
        return redirect()->back()->with('error', 'Oops! You have entered invalid credentials');
    }
    //sending user to social auth provider
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }
    //failed response
    protected function sendFailedResponse($message)
    {
        session()->flash('error', $message);
        return redirect()->route('login');
    }
    //success response
    protected function sendSuccessResponse($message)
    {
        return redirect()->intended()->with('success', $message);
    }
    //callback function returned from social auth provider
    public function handleProviderCallback($driver)
    {
        // $user = Socialite::driver($driver)->user();
        // print_r($user);
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            $message = $e->getMessage();
            return $this->sendFailedResponse($message);
        }
        // check for email in returned user
        return empty($user->email)
        ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
        : $this->loginOrCreateAccount($user, $driver);
    }
//login or create through social
    protected function loginOrCreateAccount($providerUser, $driver)
    {
        // check for already has account
        $user = User::where('email', $providerUser->getEmail())->first();
        // if user already found
        if ($user) {
            // update the avatar and provider that might have changed
            $user->update([
                'name' => $providerUser->name,
                'avatar' => $providerUser->avatar,
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token,
            ]);
            Auth::login($user);
            $message = "Login Success!";
            return $this->sendSuccessResponse($message);
        } else {
            if ($providerUser->getEmail()) { //Check email exists or not through socila auth. If exists create a new user
                $user = User::create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'avatar' => $providerUser->getAvatar(),
                    'provider' => $driver,
                    'provider_id' => $providerUser->getId(),
                    'access_token' => $providerUser->token,
                    'password' => '', // user can use reset password to create a password
                ]);
                Auth::login($user);
                $message = "Login Success!";
                return $this->sendSuccessResponse($message);
            } else {
                //Show message here what you want to show
                $message = 'No Email Found! Please use another provider';
                return $this->sendFailedResponse($message);
            }
        }
    }
    //logout user from the platform
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
