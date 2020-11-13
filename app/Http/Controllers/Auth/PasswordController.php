<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Email\MailController;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    //show forgot-password view
    public function index()
    {
        return view('auth.forgot-password');
    }
    //send forgot-password reset email
    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        //check email exists or not then send password reset mail
        if (User::where('email', $request->email)->exists()) {
            DB::beginTransaction();
            $token = Str::random(60);
            try {
                //Create Password Reset Token
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
            } catch (Exception $e) {
                DB::rollback();
                $request->session()->flash('error', $e->getMessage());
                return redirect()->back();
            }
            if (!MailController::sendResetEmail($request->email, $token)) {
                DB::rollback();
                $request->session()->flash('error', 'A Network Error occurred. Please try again.');
                return redirect()->back();
            }
            DB::commit();
            $request->session()->flash('info', 'A reset link has been sent to your email address.');
            return redirect()->route('login');

        } else {
            $request->session()->flash('error', 'This email does not exists!');
            return redirect()->back();
        }
    }
    //show reset password view
    public function showResetPassword($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }
    //reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            // 'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required',
        ]);
        $password = $request->password;
        // Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) {
            $request->session()->flash('error', 'Invalid token! Please request new one');
            return redirect()->route('forgot.password');
        }
        $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$user) {
            $request->session()->flash('error', 'Email not found');
            return redirect()->back();
        }
        DB::beginTransaction();
        try {
            //Hash and update the new password
            $user->password = Hash::make($password);
            $user->update(); //or $user->save();
            //Delete the token
            DB::table('password_resets')->where('email', $user->email)
                ->delete();
        } catch (Exception $e) {
            DB::rollback();
            $request->session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        DB::commit();
        $request->session()->flash('success', 'Password changed successfully!');
        return redirect()->route('login');
    }
}
