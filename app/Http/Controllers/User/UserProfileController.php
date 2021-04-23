<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeEmailRequest;
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
    //show edit profile
    public function index()
    {
        $user = User::current();
        return view('user.profile', compact('user'));
    }
    //update profile of user
    public function changeName(Request $request)
    {
        $user = User::current();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user->update($validatedData);
        return redirect()->route('user.profile')->with('success', 'Name changed successfully');
    }
    //change email
    public function changeEmail(ChangeEmailRequest $request)
    {
        $user = User::current();
        $email = $request->input('new_email');

        if ($user->email != $email) {
            return redirect()->back()->with('error', 'email not matched');
        }

        try {
            $user->update(['email' => $email]);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
        return redirect()->route('user.profile')->with('success', 'Email updated successfully');
    }

    //change profile picture
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
            return redirect()->back()->with('error', 'Invalid file uploaded');
        }
        return redirect()->back()->with('error', 'No file uploaded');
    }

    //soft deleting user from the database
    public function destroyUser()
    {
        $user = User::current();
        try {
            $user->delete();
        } catch (Exception $e) {
            return redirect()->intended(route('home'))->with('error', 'Something went wrong!');
        }
        return redirect()->route('home')->with('info', 'Account and all related data deleted successfully', );
    }
}
