<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{

    public static function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);

        try {
            //Here send the link with CURL with an external email API
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
