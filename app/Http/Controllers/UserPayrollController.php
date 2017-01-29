<?php

namespace App\Http\Controllers;

use App\User;
use App\UserPayroll;
use App\UserTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPayrollController extends Controller
{
    public function getPayrollList($user_id)
    {
        if (Auth::user() -> isAdmin()) {
            $ddpayrolls = DB::table('ddpayroll')->get();
            $user = User::where('id', $user_id)->first();
            $payrolls = UserPayroll::where('userid', $user_id)->orderBy('payrollcompany', 'asc')->paginate(5);
            return view('userpayroll', ['payrolls' => $payrolls, 'user' => $user, 'ddpayrolls' => $ddpayrolls]);
        } else {
            return redirect()->route('home');
        }
    }

    public function postAddPayroll(Request $request)
    {
        $this->validate($request, [
            'payroll' => 'required|max:150',
            'userid' => 'required',
        ]);

        $payroll = $request['payroll'];
        $userid = $request['userid'];

        $userpayroll = new UserPayroll();
        $userpayroll->payrollcompany = $payroll;
        $userpayroll->userid = $userid;

        $userpayroll->save();


        return redirect()->route('userpayroll', ['user_id' => $userid]);
    }

    public function getDeletePayroll($id)
    {
        $userpayroll = UserPayroll::where('id', $id)->first();
        $userid = $userpayroll->userid;
        if (Auth::user() -> isAdmin()) {
            $userpayroll->delete();
            return redirect()->route('userpayroll', ['user_id' => $userid])->with(['message' => 'Payroll deleted!']);
        }
        return redirect()->back();
    }
}
