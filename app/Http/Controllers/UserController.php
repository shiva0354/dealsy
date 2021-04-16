<?php

namespace App\Http\Controllers;

use App\Library\UserAuthGuard;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

//don't forget to implement database transaction
class UserController extends Controller
{
    use UserAuthGuard;
    //show edit profile
    public function index()
    {
        $user = User::current();
        return view('dashboard.user-profile', compact('user'));
    }
    //update profile of user
    public function changeName(Request $request)
    {
        $user = User::current();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user->update($validatedData);
        return redirect()->back()->with('success', 'Name changed successfully');
    }
    //change password when user is logged in
    public function changePassword(Request $request)
    {
        $user = User::current();
        //compare old password
        $request->validate([
            'old_password' => 'required|password|min:6|string|',
            'password' => 'required|min:6|string|confirmed',
        ]);
        DB::beginTransaction();
        try {
            $user = User::where('id', auth()->user()->id)->first();
            if (!Hash::check($request->password, $user->password)) { //comparing old password with the database
                User::find(auth()->user()->id)->update([
                    'password' => Hash::make($request->password),
                ]);
            } else {
                return redirect()->intended()->with('message', 'Old password not matched');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->intended()->with([
                'message' => $e,
            ]);
        }
        DB::commit();
        Auth::logout(); //after changing password, logout the user and send them to get login from new password
        return redirect()->intended('login')->with('message', 'Password updated successfully');
    }
    //change email
    public function changeEmail(Request $request)
    {
        $user = User::current();
        $except = "$user->id,id";
        //compare existing email
        $request->validate([
            'email' => 'required|email|max:255',
            'new_email' => 'required|email|max:255|unique:users,email,' . $except,
        ]);
        if ($user->email == $request->email) {
            try {
                $user->update([ //updating email in database
                    'email' => $request->email,
                ]);
            } catch (\Exception $e) {
                // return redirect()->intended()->with('message', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'email not matched');
        }
        return redirect()->back()->with('success', 'Email updated successfully');
    }

    //change profile picture
    public function changePicture(Request $request)
    {
        $user = User::current();
        $request->validate(['avatar' => 'required|image|mimes:png,jpg|max:1000']);
        try {
            $file = $request->file('avatar');
            $name = Str::random(60) . '.' . $file->extension();
            $file->move(public_path('uploads/users/'), $name);
            $path = 'uploads/users/' . $name;
            $user->update(['avatar' => $path]);
        } catch (\Exception $e) {
            return redirect()->back()->with('success', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Profile Picture updated');
    }

    //soft deleting user from the database
    public function destroyUser()
    {
        $user = User::current();
        //soft delete the user
        DB::beginTransaction();
        try {
            $user->delete();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->intended(route('home'))->with('error', 'Something went wrong!');
        }
        DB::commit();
        return redirect()->route('home')->with('info', 'Account and all related data deleted successfully', );
    }
}
