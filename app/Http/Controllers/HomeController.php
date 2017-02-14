<?php

namespace App\Http\Controllers;

use App\Cutoffs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list cutoffs with datediff compared to now, within 3 days
        $cutoffs = Cutoffs::select(DB::Raw('paygroup , date , datediff(date,date(now()))+1 as diffdate'))
            ->whereRaw('datediff(date,date(now())) < 4')->orderBy('date','asc')->get();


        //warning cutoff within 2 days
        include(app_path() . '/Classes/phpgrid/jqgrid_dist.php');

        include (app_path() . '/Classes/phpgrid/connect.php');

        $userid = Auth::id();

        $g = new \jqgrid($db_conf);
        $opt["toolbar"] = "top";
        $opt["caption"] = "All not Completed tickets where cutoff is within 2 days";
        $opt["autowidth"] = true;
        $opt["height"]="100px";
        $opt["shrinkToFit"] = false;
        $g->set_options($opt);

        $g->select_command = "SELECT allevents.*, datediff(cut_off_date,date(now())) as diffdate
                            FROM allevents JOIN user_payrolls ON allevents.payrollcompany = user_payrolls.payrollcompany
                           WHERE progress not like 'Completed' AND user_payrolls.userid = $userid AND datediff(cut_off_date,date(now())) < 3";
        $g->table = "allevents";

        $coe = array();
        $coe["title"] = "Ticket<br>Nr";
        $coe["name"] = "id";
        $coe["width"] = "50px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Progress";
        $coe["name"] = "progress";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe["title"] = "Assignee";
        $coe["name"] = "assignee";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Pay Group<br>Name";
        $coe["name"] = "payrollcompany";
        $coe["align"] = "center";
        $coe["width"] = "100px";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Status";
        $coe["name"] = "status";
        $coe["width"] = "80px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Workday<br>Employee Id";
        $coe["name"] = "workday_id";
        $coe["width"] = "80px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Payroll<br>System Id";
        $coe["name"] = "payroll_id";
        $coe["width"] = "80px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Event";
        $coe["name"] = "event";
        $coe["width"] = "60px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Sheet";
        $coe["name"] = "sheet";
        $coe["width"] = "70px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Name";
        $coe["name"] = "name";
        $coe["width"] = "70px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Cut-off";
        $coe["name"] = "cut_off_date";
        $coe["width"] = "80px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Edit";
        $coe["name"] = "act";
        $coe["width"] = "70";
        $coe["align"] = "center";
        $coe["hidden"] = true;
        $coes[] = $coe;

        $g->set_columns($coes);



        $g->set_actions(array(
                "add"=>false, // allow/disallow add
                "edit"=>false, // allow/disallow edit
                "delete"=>false, // allow/disallow delete
                "rowactions"=>false, // show/hide row wise edit/del/save option
                "export"=>false, // show/hide export to excel option
                "autofilter" => true, // show/hide autofilter for search
                "search" => "simple", // show single/multi field search condition (e.g. simple or advance)
            )
        );
        $g->navgrid["param"]["view"] = false;
        $g->navgrid["param"]["edit"] = false;
        $g->navgrid["param"]["add"] = false;
        $g->navgrid["param"]["del"] = false;

        $e["on_data_display"] = array(function($data){
            foreach($data["params"] as &$d)
            {
                if($d["diffdate"]<0){
                    $d["status"] = "Passed Due";
                }elseif ($d["diffdate"]<2) {
                    $d["status"] = "Urgent";
                }elseif ($d["diffdate"]<3){
                    $d["status"] = "High Priority";
                }else{
                    $d["status"] = "Low Priority";
                }
            }
        }, null, true);

        $g->set_events($e);

        $f = array();
        $f["column"] = "status"; // exact column name, as defined above in set_columns or sql field name
        $f["op"] = "cn"; // cn - contains, eq - equals
        $f["value"] = "Urgent";
        $f["cellclass"] = "urgent-row"; // css class name
        $f_conditions[] = $f;

        $f = array();
        $f["column"] = "status"; // exact column name, as defined above in set_columns or sql field name
        $f["op"] = "cn"; // cn - contains, eq - equals
        $f["value"] = "Passed";
        $f["cellclass"] = "urgent-row"; // css class name
        $f_conditions[] = $f;

        $f = array();
        $f["column"] = "assignee"; // exact column name, as defined above in set_columns or sql field name
        $f["op"] = "cn"; // cn - contains, eq - equals
        $f["value"] = "Not assigned";
        $f["cellclass"] = "urgent-row"; // css class name
        $f_conditions[] = $f;

        $g->set_conditional_css($f_conditions);

        $out = $g->render("cutoffswithin2days");

        //warning not completed owned by me within 2 days
        $username = Auth::user()->name;
        $g = new \jqgrid($db_conf);
        $opt["toolbar"] = "top";
        $opt["caption"] = "All not Completed Tickets owned by me, and not updated for 3 days";
        $opt["autowidth"] = true;
        $opt["height"]="100px";
        $opt["shrinkToFit"] = false;
        $g->set_options($opt);

        $g->select_command = "SELECT allevents.*, datediff(cut_off_date,date(now())) as diffdate
                            FROM allevents WHERE progress not like 'Completed' AND owner = '$username' AND datediff(cut_off_date,date(now())) < 3";
        $g->table = "allevents";

        $coe = array();
        $coe["title"] = "Ticket<br>Nr";
        $coe["name"] = "id";
        $coe["width"] = "50px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Progress";
        $coe["name"] = "progress";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe["title"] = "Assignee";
        $coe["name"] = "assignee";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Pay Group<br>Name";
        $coe["name"] = "payrollcompany";
        $coe["align"] = "center";
        $coe["width"] = "100px";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Status";
        $coe["name"] = "status";
        $coe["width"] = "80px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Workday<br>Employee Id";
        $coe["name"] = "workday_id";
        $coe["width"] = "80px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Payroll<br>System Id";
        $coe["name"] = "payroll_id";
        $coe["width"] = "80px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Event";
        $coe["name"] = "event";
        $coe["width"] = "60px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Sheet";
        $coe["name"] = "sheet";
        $coe["width"] = "70px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Name";
        $coe["name"] = "name";
        $coe["width"] = "70px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Cut-off";
        $coe["name"] = "cut_off_date";
        $coe["width"] = "80px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Edit";
        $coe["name"] = "act";
        $coe["width"] = "70";
        $coe["align"] = "center";
        $coe["hidden"] = true;
        $coes[] = $coe;

        $g->set_columns($coes);

        $g->set_actions(array(
                "add"=>false, // allow/disallow add
                "edit"=>false, // allow/disallow edit
                "delete"=>false, // allow/disallow delete
                "rowactions"=>false, // show/hide row wise edit/del/save option
                "export"=>false, // show/hide export to excel option
                "autofilter" => true, // show/hide autofilter for search
                "search" => "simple", // show single/multi field search condition (e.g. simple or advance)
            )
        );
        $g->navgrid["param"]["view"] = false;
        $g->navgrid["param"]["edit"] = false;
        $g->navgrid["param"]["add"] = false;
        $g->navgrid["param"]["del"] = false;

        $e["on_data_display"] = array(function($data){
            foreach($data["params"] as &$d)
            {
                if($d["diffdate"]<0){
                    $d["status"] = "Passed Due";
                }elseif ($d["diffdate"]<2) {
                    $d["status"] = "Urgent";
                }elseif ($d["diffdate"]<3){
                    $d["status"] = "High Priority";
                }else{
                    $d["status"] = "Low Priority";
                }
            }
        }, null, true);

        $g->set_events($e);

        $f = array();
        $f["column"] = "status"; // exact column name, as defined above in set_columns or sql field name
        $f["op"] = "cn"; // cn - contains, eq - equals
        $f["value"] = "Urgent";
        $f["cellclass"] = "urgent-row"; // css class name
        $f_conditions[] = $f;

        $f = array();
        $f["column"] = "status"; // exact column name, as defined above in set_columns or sql field name
        $f["op"] = "cn"; // cn - contains, eq - equals
        $f["value"] = "Passed";
        $f["cellclass"] = "urgent-row"; // css class name
        $f_conditions[] = $f;

        $f = array();
        $f["column"] = "assignee"; // exact column name, as defined above in set_columns or sql field name
        $f["op"] = "cn"; // cn - contains, eq - equals
        $f["value"] = "Not assigned";
        $f["cellclass"] = "urgent-row"; // css class name
        $f_conditions[] = $f;

        $g->set_conditional_css($f_conditions);

        $out2 = $g->render("nottouchedsince2days");



        return view('home', array('cutoffswithin2days_output' => $out, 'nottouchedsince2days_output' => $out2), ['cutoffs' => $cutoffs]);
    }
}
