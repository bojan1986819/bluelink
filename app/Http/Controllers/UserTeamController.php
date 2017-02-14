<?php

namespace App\Http\Controllers;

use App\User;
use App\UserPayroll;
use App\UserTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserTeamController extends Controller
{
    public function getTeamList($user_id)
    {
        if (Auth::user() -> isAdmin()) {
            $ddteams = DB::table('ddteam')->get();
            $user = User::where('id', $user_id)->first();
            $teams = UserTeam::where('userid', $user_id)->orderBy('team', 'asc')->paginate(5);
            return view('userteam', ['teams' => $teams, 'user' => $user, 'ddteams' => $ddteams]);
        } else {
            return redirect()->route('home');
        }
    }

    public function postAddTeam(Request $request)
    {
        $this->validate($request, [
            'team' => 'required|max:120',
            'userid' => 'required',
        ]);

        $team = $request['team'];
        $userid = $request['userid'];

        $userteam = new UserTeam();
        $userteam->team = $team;
        $userteam->userid = $userid;

        $userteam->save();


        return redirect()->route('userteam', ['user_id' => $userid])->with(['message' => 'Team added!']);
    }

    public function getDeleteTeam($id)
    {
        $userteam = UserTeam::where('id', $id)->first();
        $userid = $userteam->userid;
        if (Auth::user() -> isAdmin()) {
            $userteam->delete();
            return redirect()->route('userteam', ['user_id' => $userid])->with(['message' => 'Team deleted!']);
        }
        return redirect()->back();
    }

}
