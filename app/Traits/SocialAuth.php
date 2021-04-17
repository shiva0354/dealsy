<?php

namespace App\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

trait SocialAuth
{

    protected function getUserByEmail($email)
    {}

    protected function createUserOnLogin($socialiteUser)
    {}

    protected function homePath()
    {
        $guard = $this->guard ?? null;
        return route($guard ? "$guard.home" : 'home');
    }

    /**
     * Get the login url for this guard
     *
     * @return string
     */
    protected function loginPath()
    {
        $guard = $this->guard ?? null;
        return route($guard ? "$guard.login" : 'login');
    }

/**
 * @param Request $request
 * @param string $provider
 * @return OAuthProvider
 */
    protected function socialiteProvider(Request $request, $provider = null)
    {
        if (!is_array($this->providers)) {
            abort(404, "Invalid OAUTH providers list");
        }

        if (empty($this->providers)) {
            abort(404, "Empty OAUTH providers list");
        }

        if ($provider == null) {
            $provider = $this->providers[0];
        } else if (!in_array($provider, $this->providers)) {
            abort(404, "Invalid OAUTH providers '$provider'");
        }

        $driver = Socialite::driver($provider);
        return $driver;
    }

    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param Request $request
     * @param string|null $provider
     * @return RedirectResponse
     */

    public function redirectToProvider(Request $request, $provider = null)
    {
        return $this->socialiteProvider($request, $provider)->redirect();
    }

    /**
     * Obtain the user information from the Provider.
     *
     * @param Request $request
     * @param string|null $provider
     * @return RedirectResponse
     */

    public function handleProviderCallback(Request $request, $provider = null)
    {

        $driver = $this->socialiteProvider($request, $provider);

        $socialiteUser = $driver->user();

        if (!$socialiteUser) {
            return redirect($this->loginPath())->with('error', 'Some Error occurred');
        }

        $email = $socialiteUser->getEmail();

        if (!$email) {
            return redirect($this->loginPath())->with('error', 'Error: No Email available.');
        }

        $user = $this->getUserByEmail($email);

        if (!$user) {
            $user = $this->createUserOnLogin($socialiteUser, $provider);
        }

        if (!$user) {
            return redirect($this->loginPath())->with('error', "Invalid account: '$email'");
        }

        return $this->loginUser($request, $user);
    }

    /**
     * Log in the user into the application.
     *
     * @param Request $request
     * @param $user
     * @return RedirectResponse
     */

    private function loginUser(Request $request, $user)
    {
        $this->guard()->login($user, true);
        $request->session()->regenerate();
        return redirect()->intended($this->homePath());
    }
}
