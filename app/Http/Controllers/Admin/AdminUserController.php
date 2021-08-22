<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(30);
        return view('admin.user-index', compact('users'));
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->paginate(10);
        $posts->load(['postImages', 'category']);
        return view('admin.user-show', compact('user', 'posts'));
    }

    /**
     * Deleting the specified user from system.
     *
     * @param  int  $id
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->posts()->count()) {
            return back()->with('error', 'Cannot delete user. User has posts.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
