<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeEmailRequest;
use App\Http\Requests\MobileRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Displaying form for editing user profile
     */
    public function index()
    {
        $user = User::current();
        return view('user.profile', compact('user'));
    }

    /**
     * Updating name of the user
     * @param Request $request
     * @param User $user
     */
    public function changeName(Request $request)
    {
        $user = User::current();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user->update($validatedData);
        return redirect()->route('user.profile')->with('success', 'Name changed successfully');
    }

    /**
     * Updating email of the user
     * @param ChangeEmailRequest $request
     * @param User $user
     */
    public function changeEmail(ChangeEmailRequest $request)
    {
        $user = User::current();
        $email = $request->input('new_email');

        if ($user->email != $email) {
            return back()->with('error', 'email not matched');
        }

        try {
            $user->update(['email' => $email]);
        } catch (\Exception $e) {
            return back()->with('message', $e->getMessage());
        }
        return redirect()->route('user.profile')->with('success', 'Email updated successfully');
    }

    /**
     * Changing profile image of the user
     * @param ProfileImageRequest $request
     * @param User $user
     */
    public function changePicture(ProfileImageRequest $request)
    {
        $user = User::current();
        $dir = "/uploads/users/";
        $destinationPath = public_path($dir);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            if ($file->isValid()) {
                $ext = $file->getClientOriginalExtension();
                $fileName = Str::random(30) . "." . $ext;
                $file->move($destinationPath, $fileName);
                $path = $dir . $fileName;
                $user->update(['avatar' => $path]);
                return redirect()->route('user.profile')->with('success', 'Profile image updated successfully');
            }
            return back()->with('error', 'Invalid file uploaded');
        }
        return back()->with('error', 'No file uploaded');
    }

    /**
     * Changing mobile of the user
     * @param MobileRequest $request
     * @param User $user
     */
    public function changeMobile(MobileRequest $request)
    {
        $user = User::current();

        if ($user->mobile && $user->mobile != $request->input('old_mobile')) {
            return back()->with('error', 'old mobile do not matched');
        }
        $user->update(['mobile' => $request->input('mobile')]);
        return redirect()->route('user.profile')->with('success', 'Mobile updated successfully');
    }

    /**
     * Soft deleting user from the database
     * @param User $user
     */
    public function destroyUser()
    {
        $user = User::current();
        try {
            $user->delete();
        } catch (Exception $e) {
            return redirect()->intended(route('home'))->with('error', 'Something went wrong!');
        }
        return redirect()->route('home')->with('info', 'Account and all related data deleted successfully',);
    }
}
