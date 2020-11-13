<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function create(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $validateData['password'] = Hash::make($request->password);
        if (User::where('email', $request->email)->exists()) {
            session()->flash('warning', 'This email is already registered with us!');
            return redirect()->back();
        }
        DB::beginTransaction();
        try {
            $user = User::create($validateData);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
        DB::commit();
        Auth::login($user);
        session()->flash('success', 'Account created successfully');
        return redirect()->route('home');
    }
}
