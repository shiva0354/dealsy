<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

// Here only  login and signup related functions is definded
class LoginController extends Controller
{
    protected $providers = [
        'github', 'facebook', 'google', 'twitter',
    ];
    //show login view
    public function showLoginPage()
    {
        return view('login');
    }

    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }
    /**
     * Obtain the user information from Social.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($driver)
    {
        // $user = Socialite::driver($driver)->user();
        // print_r($user);
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
        // check for email in returned user
        return empty($user->email)
        ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
        : $this->loginOrCreateAccount($user, $driver);
    }
    //Send success response
    protected function sendSuccessResponse($email)
    {
        session()->put('email', $email);
        //return redirect()->route('home');
        return redirect()->intended(route('home'));
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
            return $this->sendSuccessResponse($providerUser->getEmail());
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
                return $this->sendSuccessResponse($providerUser->getEmail());
            } else {
                //Show message here what you want to show
                return redirect(route('/login'), ['message' => 'No Email Found! Please use another provider']);
            }
        }
    }
// signup through email and password
    public function userSignup(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // update the avatar and provider that might have changed
            $data = 'provided email is already registered! please login or reset password';
            $request->session()->flash('user', $data);
            return redirect(route('user.signup'));
        } else {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $request->session()->put('email', $request->email);
            return redirect()->route('home');
        }
        // return $request->input();
    }
// login through email and password
    public function emailLogin(Request $request)
    {
        $userdata = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        $user = User::where('email', $request->email)->first();
        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->put('email', $request->email);
            return $this->sendSuccessResponse($request->email);

        } else {
            // validation not successful, send back to form
            $request->session()->flash('user', 'Wrong Credential!');
            return redirect()->route('login');
        }
    }

    public function userView()
    {
        if (auth()->user()) {
            return auth()->user();
        }
        return redirect('/');

    }
}
