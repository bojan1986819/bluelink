<?php

namespace App\Http\Controllers;

use App\User;
use App\UserPayroll;
use App\UserTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getUserList()
    {
        if (Auth::user() -> isAdmin()) {
            $users = User::orderBy('name', 'asc')->paginate(5);
            return view('users', ['users' => $users]);
        } else {
            return redirect()->route('home');
        }
    }

    public function getDeleteUser($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $userteam = UserTeam::where('userid', $user_id);
        $userpayroll = UserPayroll::where('userid', $user_id);
        if (Auth::user() -> isAdmin()) {
            $user->delete();
            $userteam->delete();
            $userpayroll->delete();
            return redirect()->route('users')->with(['message' => 'User deleted!']);
        }
        return redirect()->back();
    }
}
