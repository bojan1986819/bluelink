<?php

namespace App\Http\Controllers;

use App\Allevents;
use App\Log;
use App\UserTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AllEventsController extends Controller
{

    public function phpgridAllTickets(){

        include(app_path() . '/Classes/phpgrid/jqgrid_dist.php');

        include (app_path() . '/Classes/phpgrid/connect.php');

        $g = new \jqgrid($db_conf);
        $opt["toolbar"] = "top";
        $opt["caption"] = "All Not Completed Tickets";
        $opt["autowidth"] = true;
//        $opt["width"] = "1200";
        $opt["shrinkToFit"] = false;
        $opt["resizable"] = true;
        $opt["height"] = "400px";
        $opt["multiselect"] = false;

        $g->set_options($opt);
        $g->select_command = "SELECT *, datediff(cut_off_date,date(now())) as diffdate FROM allevents WHERE progress <> 'Completed'";
        $g->table = "allevents";

        $coe = array();
        $coe["title"] = "Ticket<br>Nr";
        $coe["name"] = "id";
        $coe["width"] = "50px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Progress";
        $coe["name"] = "progress";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Assignee";
        $coe["name"] = "assignee";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Team";
        $coe["name"] = "team";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Owner";
        $coe["name"] = "owner";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Owner<br>Team";
        $coe["name"] = "owner_team";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Method";
        $coe["name"] = "method";
        $coe["width"] = "80px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "NGA<br>Ticket Nr";
        $coe["name"] = "nga_ticket_nr";
        $coe["width"] = "80px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Remark";
        $coe["name"] = "remark";
        $coe["width"] = "100px";
        $coe["align"] = "left";
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
        $coe["title"] = "Change File Name";
        $coe["name"] = "wdfilename";
        $coe["width"] = "120px";
        $coe["align"] = "left";
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
        $coe["title"] = "Effective<br>Moment";
        $coe["name"] = "effective_moment";
        $coe["width"] = "60px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Cut-off";
        $coe["name"] = "cut_off_date";
        $coe["width"] = "60px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Entry<br>Moment";
        $coe["name"] = "entry_moment";
        $coe["width"] = "60px";
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
                "rowactions"=>true
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

        $out = $g->render("alltickets");
        return view('alltickets', array('alltickets_output' => $out));
    }

    public function phpgridAllOpenTickets(){

        include(app_path() . '/Classes/phpgrid/jqgrid_dist.php');

        include (app_path() . '/Classes/phpgrid/connect.php');

        $userid = Auth::id();
        $g = new \jqgrid($db_conf);
        $opt["toolbar"] = "top";
        $opt["caption"] = "All Not Completed Tickets";
        $opt["autowidth"] = true;
//        $opt["width"] = "1200";
        $opt["shrinkToFit"] = true;
        $opt["resizable"] = true;
        $opt["height"] = "400px";
        $opt["multiselect"] = false;

        $g->set_options($opt);
        $g->select_command = "SELECT allevents.*, datediff(cut_off_date,date(now())) as diffdate FROM allevents
                          JOIN user_payrolls ON allevents.payrollcompany = user_payrolls.payrollcompany
                           WHERE progress like 'Open' AND user_payrolls.userid = $userid";
        $g->table = "allevents";

        $coe = array();
        $coe["title"] = "Action";
        $coe["name"] = "button";
        $coe["default"] = "<a class='btn btn-primary' href='addtomyqueue/{id}' style='border-radius: 6px;
            width: 3cm;
            height: 0.8cm;
            font: 12px calibri, arial;
            color: white;
            background-color: #8FB1D5 !important;'>Put in my queue</a>";
        $coe["width"] = "120";
        $coe["align"] = "center";
        $coe["editable"] = false;
        $coe["search"] = false;
        $coe["export"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Ticket<br>Nr";
        $coe["name"] = "id";
        $coe["width"] = "50px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Progress";
        $coe["name"] = "progress";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Pay Group<br>Name";
        $coe["name"] = "payrollcompany";
        $coe["dbname"] = "allevents.payrollcompany";
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
        $coe["title"] = "Change File Name";
        $coe["name"] = "wdfilename";
        $coe["width"] = "200px";
        $coe["align"] = "left";
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
        $coe["title"] = "Effective<br>Moment";
        $coe["name"] = "effective_moment";
        $coe["width"] = "80px";
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
                "rowactions"=>true
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
        $e["on_update"] =array(function($data){
            $nowdate = date('y/m/d');
            $data["params"]["updated_at"] = $nowdate;
            $assignee = $data["params"]["assignee"];
            $team = $data["params"]["team"];
            $ticketnr = $data["params"]["id"];
            Log::insert([
                'progress' => $data["params"]["progress"],
                'method' => $data["params"]["method"],
                'nga_ticket_nr' => $data["params"]["nga_ticket_nr"],
                'old_assignee' => 'Not assigned',
                'new_assignee' => $assignee,
                'old_team' => 'No Team',
                'new_team' => $team,
                'start_task_time' => $nowdate,
                'ticketid' => $ticketnr
            ]);

        }, null, true);
        $g->set_events($e);

        $out = $g->render("allopentickets");
        return view('allopentickets', array('allopentickets_output' => $out));
    }

    public function getAddToMyQueue($id){
        $userid = Auth::id();
        $username = Auth::user()->name;
        $userteam = UserTeam::where('userid','=',$userid)->value('team');
        $allevents = Allevents::where('id','=',$id)->first();
        $nowdate = date('y/m/d');

        if($allevents->assignee == "Not assigned" && $allevents->progress == "Open"){
            $allevents->progress = "In Progress";
            $allevents->assignee = $username;
            $allevents->team = $userteam;
            $allevents->owner = $username;
            $allevents->owner_team = $userteam;
            $allevents->save();

            Log::insert([
                'progress' => $allevents->progress,
                'method' => $allevents->method,
                'nga_ticket_nr' => $allevents->nga_ticket_nr,
                'old_assignee' => 'Not assigned',
                'new_assignee' => $username,
                'old_team' => 'No Team',
                'new_team' => $userteam,
                'start_task_time' => $nowdate,
                'ticketid' => $id
            ]);

            return back()->with(['message' => 'Ticket '.$id.' moved into yor queue']);
        } elseif($allevents->assignee == "Not assigned" && $allevents->progress != "Open"){
            $allevents->assignee = $username;
            $allevents->save();

            Log::insert([
                'progress' => $allevents->progress,
                'method' => $allevents->method,
                'nga_ticket_nr' => $allevents->nga_ticket_nr,
                'old_assignee' => 'Not assigned',
                'new_assignee' => $username,
                'old_team' =>  $allevents->team,
                'new_team' => $allevents->team,
                'start_task_time' => $nowdate,
                'ticketid' => $id
            ]);

            return back()->with(['message' => 'Ticket '.$id.' moved into yor queue']);
        } else {
            return back()->with(['message' => 'Ticket '.$id.' is already taken by user '. $allevents->assignee]);
        }
    }

    public function phpgridMyTickets(){

        include(app_path() . '/Classes/phpgrid/jqgrid_dist.php');

        include (app_path() . '/Classes/phpgrid/connect.php');

        $username = Auth::user()->name;

        $g = new \jqgrid($db_conf);
        $opt["toolbar"] = "top";
        $opt["caption"] = "My Tickets";
        $opt["autowidth"] = true;
        $opt["shrinkToFit"] = false;
        $opt["resizable"] = true;
        $opt["multiselect"] = true;
        $opt["reloadedit"] = true;
//        $opt["sortable"] = false;


        $g->set_options($opt);
        $g->select_command = "SELECT allevents.*, datediff(cut_off_date,date(now())) as diffdate
                            FROM allevents
                           WHERE progress not like 'Completed' AND allevents.assignee like '$username'";
        $g->table = "allevents";

        $coe = array();
        $coe["title"] = "ID";
        $coe["name"] = "id";
        $coe["width"] = "50px";
        $coe["align"] = "center";
        $coe["hidden"] = true;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Edit";
        $coe["name"] = "act";
        $coe["width"] = "30";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Action";
        $coe["name"] = "button";
        $coe["default"] = "<a class='btn btn-primary' href='reassign/{id}' style='border-radius: 6px;
            width: 3cm;
            height: 0.8cm;
            font: 12px calibri, arial;
            color: white;
            background-color: #8FB1D5 !important;'>Reassign</a>";
        $coe["width"] = "120";
        $coe["align"] = "center";
        $coe["frozen"] = true;
        $coe["editable"] = false;
        $coe["search"] = false;
        $coe["export"] = false;
        $coes[] = $coe;

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
        $coe["editable"] = true;
        $coe["frozen"] = true;
        $coe["show"]["edit"] = false;
        $coe["show"]["list"] = true;
        $coe["edittype"] = "select";
        $str = $g->get_dropdown_values("select distinct progress as k, progress as v from ddprogress");
        $coe["editoptions"] = array("value"=>$str);
        $coe["formatter"] = "select";
        $coe["formatoptions"] = array("value"=>$str);
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Method";
        $coe["name"] = "method";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = true;
        $coe["frozen"] = true;
        $coe["edittype"] = "select";
        $str = $g->get_dropdown_values("select distinct method as k, method as v from ddmethod");
        $coe["editoptions"] = array("value"=>":;".$str);
        $coe["formatter"] = "select";
        $coe["formatoptions"] = array("value"=>":;".$str);
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "NGA<br>Ticket Nr";
        $coe["name"] = "nga_ticket_nr";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = true;
        $coe["frozen"] = true;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Remark";
        $coe["name"] = "remark";
        $coe["width"] = "200px";
        $coe["align"] = "left";
        $coe["hidden"] = false;
        $coe["editable"] = true;
        $coe["frozen"] = true;
        $coes[] = $coe;
        $coe = array();

        $coe["title"] = "Team";
        $coe["name"] = "team";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coe["edittype"] = "select";
        $str = $g->get_dropdown_values("select distinct team as k, team as v from ddteam");
        $coe["editoptions"] = array("value"=>":;".$str);
        $coe["formatter"] = "select";
        $coe["formatoptions"] = array("value"=>":;".$str);
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
        $coe["title"] = "Change File Name";
        $coe["name"] = "wdfilename";
        $coe["width"] = "200px";
        $coe["align"] = "left";
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
        $coe["title"] = "Effective<br>Moment";
        $coe["name"] = "effective_moment";
        $coe["width"] = "80px";
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

        $g->set_columns($coes);



        $g->set_actions(array(
                "add"=>false, // allow/disallow add
                "edit"=>true, // allow/disallow edit
                "delete"=>false, // allow/disallow delete
                "rowactions"=>true, // show/hide row wise edit/del/save option
                "export"=>false, // show/hide export to excel option
                "autofilter" => true, // show/hide autofilter for search
                "search" => "simple", // show single/multi field search condition (e.g. simple or advance)
                "bulkedit"=>true
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

        $e["on_update"] = array(function($data){
            $selected_ids=$data["params"]["id"];
            $ids = explode(",",$selected_ids);
            $userteam = Auth::user()->team;
            $nowdate = date('y/m/d');

            if ($data["params"]["bulk"] == "set-completed")
            {

                foreach ($ids as $id){
                    Allevents::where('id', '=', $id)
                        ->where('method','<>',null)
                        ->update(['progress' => 'Completed']);

                    $ticket = Allevents::where('id', $id)->first();
                    if($ticket->method != null) {
                        $ticketnr = $id;
                        $oldlog = Log::where('ticketid', $ticketnr)->orderBy('start_task_time', 'desc')->first();

                        //add log
                        Log::insert([
                            'progress' => 'Completed',
                            'method' => $ticket->method,
                            'nga_ticket_nr' => $ticket->nga_ticket_nr,
                            'old_assignee' => $oldlog->new_assignee,
                            'new_assignee' => $ticket->assignee,
                            'old_team' => $oldlog->new_team,
                            'new_team' => $ticket->team,
                            'start_task_time' => $nowdate,
                            'ticketid' => $ticketnr
                        ]);
                    }
                }

                die;
            } else {

                foreach($ids as $id) {

                    if ($data["params"]["progress"] == "Completed") {
                        if ($data["params"]["method"] == null) {
                            phpgrid_error("Choose Method!");
                        }
                    }

                    if ($data["params"]["team"] != $userteam) {
                        $data["params"]["assignee"] = "Not assigned";
                    }

                    $data["params"]["updated_at"] = $nowdate;
                    $ticketnr = $id;
                    $oldlog = Log::where('ticketid', $ticketnr)->orderBy('start_task_time', 'desc')->first();
                    $ticket = Allevents::where('id', $id)->first();
                    if ($data["params"]["progress"] == "Open") {
                        Allevents::where('id', '=', $id)
                            ->update(['assignee' => 'Not assigned',
                                'team' => '',
                                'owner' => '',
                                'owner_team' => '']);
                        //add log

                        Log::insert([
                            'progress' => $data["params"]["progress"],
                            'method' => $data["params"]["method"],
                            'nga_ticket_nr' => $data["params"]["nga_ticket_nr"],
                            'old_assignee' => $oldlog->new_assignee,
                            'new_assignee' => 'Not assigned',
                            'old_team' => $oldlog->new_team,
                            'new_team' => '',
                            'start_task_time' => $nowdate,
                            'ticketid' => $ticketnr
                        ]);
                    } else {
                        //add log
                        Log::insert([
                            'progress' => $data["params"]["progress"],
                            'method' => $data["params"]["method"],
                            'nga_ticket_nr' => $data["params"]["nga_ticket_nr"],
                            'old_assignee' => $oldlog->new_assignee,
                            'new_assignee' => $ticket->assignee,
                            'old_team' => $oldlog->new_team,
                            'new_team' => $ticket->team,
                            'start_task_time' => $nowdate,
                            'ticketid' => $ticketnr
                        ]);
                    }
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

        $g->set_conditional_css($f_conditions);

        $out = $g->render("mytickets");
        return view('mytickets', array('mytickets_output' => $out));
    }

    public function getReassignTicket($id){
        $ticket = Allevents::where('id',$id)->first();
        $ddteams = DB::table('ddteam')->get();

        return view('reassign',['ticket'=>$ticket, 'ddteams'=>$ddteams]);
    }

    public function postReassignTicket(Request $request)
    {
        $this->validate($request, [
            'team' => 'required|max:120',
            'ticketid' => 'required',
        ]);

        $team = $request['team'];
        $ticketid = $request['ticketid'];
        $allevents = Allevents::where('id','=',$ticketid)->first();


        Allevents::where('id',$ticketid)->update(['team'=>$team,'assignee'=>'Not assigned']);

        $nowdate = date('y/m/d');

        Log::insert([
            'progress' => $allevents->progress,
            'method' => $allevents->method,
            'nga_ticket_nr' => $allevents->nga_ticket_nr,
            'old_assignee' => $allevents->assignee,
            'new_assignee' => 'Not assigned',
            'old_team' => $allevents->team,
            'new_team' => $team,
            'start_task_time' => $nowdate,
            'ticketid' => $ticketid
        ]);


        return redirect()->route('mytickets')->with(['message' => 'Ticket '.$ticketid.' reassigned!']);
    }

    public function phpgridTeamTickets(){

        include(app_path() . '/Classes/phpgrid/jqgrid_dist.php');

        include (app_path() . '/Classes/phpgrid/connect.php');

        $userid = Auth::id();

        $g = new \jqgrid($db_conf);
        $opt["toolbar"] = "top";
        $opt["caption"] = "Team Tickets";
        $opt["autowidth"] = true;
        $opt["shrinkToFit"] = false;
        $opt["resizable"] = true;
        $opt["reloadedit"] = true;


        $g->set_options($opt);
        $g->select_command = "SELECT allevents.*, datediff(cut_off_date,date(now())) as diffdate
                            FROM allevents JOIN user_teams ON allevents.team = user_teams.team
                           WHERE progress not like 'Completed' AND user_teams.userid = $userid";
        $g->table = "allevents";

        $coe = array();
        $coe["title"] = "ID";
        $coe["name"] = "id";
        $coe["width"] = "50px";
        $coe["align"] = "center";
        $coe["hidden"] = true;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Action";
        $coe["name"] = "button";
        $coe["default"] = "<a class='btn btn-primary' href='addtomyqueue/{id}' style='border-radius: 6px;
            width: 3cm;
            height: 0.8cm;
            font: 12px calibri, arial;
            color: white;
            background-color: #8FB1D5 !important;'>Put in my queue</a>";
        $coe["width"] = "120";
        $coe["align"] = "center";
        $coe["editable"] = false;
        $coe["search"] = false;
        $coe["export"] = false;
        $coes[] = $coe;

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

        $coe = array();
        $coe["title"] = "Method";
        $coe["name"] = "method";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "NGA<br>Ticket Nr";
        $coe["name"] = "nga_ticket_nr";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Remark";
        $coe["name"] = "remark";
        $coe["width"] = "200px";
        $coe["align"] = "left";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;
        $coe = array();

        $coe["title"] = "Assignee";
        $coe["name"] = "assignee";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe["title"] = "Team";
        $coe["name"] = "team";
        $coe["dbname"] = "allevents.team";
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
        $coe["title"] = "Change File Name";
        $coe["name"] = "wdfilename";
        $coe["width"] = "200px";
        $coe["align"] = "left";
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
        $coe["title"] = "Effective<br>Moment";
        $coe["name"] = "effective_moment";
        $coe["width"] = "80px";
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

        $out = $g->render("teamtickets");
        return view('teamtickets', array('teamtickets_output' => $out));
    }

    public function phpgridTeamFollowUps(){

        include(app_path() . '/Classes/phpgrid/jqgrid_dist.php');

        include (app_path() . '/Classes/phpgrid/connect.php');

        $userid = Auth::id();

        $g = new \jqgrid($db_conf);
        $opt["toolbar"] = "top";
        $opt["caption"] = "Team Follow Ups";
        $opt["autowidth"] = true;
        $opt["shrinkToFit"] = false;
        $opt["resizable"] = true;
        $opt["reloadedit"] = true;


        $g->set_options($opt);
        $g->select_command = "SELECT allevents.*, datediff(cut_off_date,date(now())) as diffdate
                            FROM allevents JOIN user_teams ON allevents.owner_team = user_teams.team
                           WHERE progress not like 'Completed' AND user_teams.userid = $userid";
        $g->table = "allevents";

        $coe = array();
        $coe["title"] = "ID";
        $coe["name"] = "id";
        $coe["width"] = "50px";
        $coe["align"] = "center";
        $coe["hidden"] = true;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

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

        $coe = array();
        $coe["title"] = "Method";
        $coe["name"] = "method";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "NGA<br>Ticket Nr";
        $coe["name"] = "nga_ticket_nr";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Remark";
        $coe["name"] = "remark";
        $coe["width"] = "200px";
        $coe["align"] = "left";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;
        $coe = array();

        $coe["title"] = "Assignee";
        $coe["name"] = "assignee";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe["title"] = "Team";
        $coe["name"] = "team";
        $coe["dbname"] = "allevents.team";
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
        $coe["title"] = "Change File Name";
        $coe["name"] = "wdfilename";
        $coe["width"] = "200px";
        $coe["align"] = "left";
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
        $coe["title"] = "Effective<br>Moment";
        $coe["name"] = "effective_moment";
        $coe["width"] = "80px";
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

        $out = $g->render("teamfollowups");
        return view('teamfollowups', array('teamfollowups_output' => $out));
    }

    public function phpgridMyFollowUps(){

        include(app_path() . '/Classes/phpgrid/jqgrid_dist.php');

        include (app_path() . '/Classes/phpgrid/connect.php');

        $username = Auth::user()->name;

        $g = new \jqgrid($db_conf);
        $opt["toolbar"] = "top";
        $opt["caption"] = "My Follow Ups";
        $opt["autowidth"] = true;
        $opt["shrinkToFit"] = false;
        $opt["resizable"] = true;
        $opt["reloadedit"] = true;


        $g->set_options($opt);
        $g->select_command = "SELECT allevents.*, datediff(cut_off_date,date(now())) as diffdate
                            FROM allevents WHERE progress not like 'Completed' AND owner like '$username'";
        $g->table = "allevents";

        $coe = array();
        $coe["title"] = "ID";
        $coe["name"] = "id";
        $coe["width"] = "50px";
        $coe["align"] = "center";
        $coe["hidden"] = true;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

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

        $coe = array();
        $coe["title"] = "Method";
        $coe["name"] = "method";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "NGA<br>Ticket Nr";
        $coe["name"] = "nga_ticket_nr";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Remark";
        $coe["name"] = "remark";
        $coe["width"] = "200px";
        $coe["align"] = "left";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;
        $coe = array();

        $coe["title"] = "Assignee";
        $coe["name"] = "assignee";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe["title"] = "Team";
        $coe["name"] = "team";
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
        $coe["title"] = "Change File Name";
        $coe["name"] = "wdfilename";
        $coe["width"] = "200px";
        $coe["align"] = "left";
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
        $coe["title"] = "Effective<br>Moment";
        $coe["name"] = "effective_moment";
        $coe["width"] = "80px";
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

        $out = $g->render("myfollowups");
        return view('myfollowups', array('myfollowups_output' => $out));
    }

    public function phpgridCompletedTickets(){

        include(app_path() . '/Classes/phpgrid/jqgrid_dist.php');

        include (app_path() . '/Classes/phpgrid/connect.php');

        $userid = Auth::id();

        $g = new \jqgrid($db_conf);
        $opt["toolbar"] = "top";
        $opt["caption"] = "Team Archive";
        $opt["autowidth"] = true;
        $opt["shrinkToFit"] = false;
        $opt["resizable"] = true;
        $opt["reloadedit"] = true;


        $g->set_options($opt);
        $g->select_command = "SELECT allevents.*, datediff(cut_off_date,date(now())) as diffdate
                            FROM allevents JOIN user_payrolls ON allevents.payrollcompany = user_payrolls.payrollcompany
                           WHERE progress like 'Completed'";
        $g->table = "allevents";

        $coe = array();
        $coe["title"] = "ID";
        $coe["name"] = "id";
        $coe["width"] = "50px";
        $coe["align"] = "center";
        $coe["hidden"] = true;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Action";
        $coe["name"] = "button";
        $coe["default"] = "<a class='btn btn-primary' href='reopen/{id}' id='reopenbtn' style='border-radius: 6px;
            width: 3cm;
            height: 0.8cm;
            font: 12px calibri, arial;
            color: white;
            background-color: #8FB1D5 !important;'>Reopen ticket</a>";
        $coe["width"] = "120";
        $coe["align"] = "center";
        $coe["editable"] = false;
        $coe["search"] = false;
        $coe["export"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Ticket<br>Nr";
        $coe["name"] = "id";
        $coe["width"] = "50px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

        $coe["title"] = "Closing Agent";
        $coe["name"] = "assignee";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe["title"] = "Team";
        $coe["name"] = "team";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe["title"] = "Closing date";
        $coe["name"] = "updated_at";
        $coe["width"] = "80px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Method";
        $coe["name"] = "method";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "NGA<br>Ticket Nr";
        $coe["name"] = "nga_ticket_nr";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Remark";
        $coe["name"] = "remark";
        $coe["width"] = "200px";
        $coe["align"] = "left";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;
        $coe = array();

        $coe = array();
        $coe["title"] = "Pay Group<br>Name";
        $coe["name"] = "payrollcompany";
        $coe["dbname"] = "allevents.payrollcompany";
        $coe["align"] = "center";
        $coe["width"] = "100px";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Change File Name";
        $coe["name"] = "wdfilename";
        $coe["width"] = "200px";
        $coe["align"] = "left";
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
        $coe["title"] = "Effective<br>Moment";
        $coe["name"] = "effective_moment";
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

        $out = $g->render("completedtickets");
        return view('completedtickets', array('completedtickets_output' => $out));
    }

    public function phpgridInProgressTickets(){

        include(app_path() . '/Classes/phpgrid/jqgrid_dist.php');

        include (app_path() . '/Classes/phpgrid/connect.php');

        $g = new \jqgrid($db_conf);
        $opt["toolbar"] = "top";
        $opt["caption"] = "All In Progress Tickets";
        $opt["autowidth"] = true;
        $opt["shrinkToFit"] = false;
        $opt["resizable"] = true;
        $opt["reloadedit"] = true;


        $g->set_options($opt);
        $g->select_command = "SELECT allevents.*, datediff(cut_off_date,date(now())) as diffdate
                            FROM allevents JOIN user_payrolls ON allevents.payrollcompany = user_payrolls.payrollcompany
                           WHERE progress like 'In Progress' OR progress like 'In Progress NGA'";
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

        $coe = array();
        $coe["title"] = "Method";
        $coe["name"] = "method";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "NGA<br>Ticket Nr";
        $coe["name"] = "nga_ticket_nr";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Remark";
        $coe["name"] = "remark";
        $coe["width"] = "200px";
        $coe["align"] = "left";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coe["frozen"] = true;
        $coes[] = $coe;
        $coe = array();

        $coe["title"] = "Assignee";
        $coe["name"] = "assignee";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe["title"] = "Team";
        $coe["name"] = "team";
        $coe["width"] = "100px";
        $coe["align"] = "center";
        $coe["hidden"] = false;
        $coe["editable"] = false;
        $coes[] = $coe;

        $coe = array();
        $coe["title"] = "Pay Group<br>Name";
        $coe["name"] = "payrollcompany";
        $coe["dbname"] = "allevents.payrollcompany";
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
        $coe["title"] = "Change File Name";
        $coe["name"] = "wdfilename";
        $coe["width"] = "200px";
        $coe["align"] = "left";
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
        $coe["title"] = "Effective<br>Moment";
        $coe["name"] = "effective_moment";
        $coe["width"] = "80px";
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

        $out = $g->render("inprotickets");
        return view('inprotickets', array('inprotickets_output' => $out));
    }

    public function getReopenTicket($id)
    {
        $userid = Auth::id();
        $username = Auth::user()->name;
        $userteam = UserTeam::where('userid', '=', $userid)->value('team');
        $allevents = Allevents::where('id', '=', $id)->first();
        $nowdate = date('y/m/d');
        $log = Log::where('ticketid',$id)->orderBy('start_task_time','desc')->first();

        $allevents->progress = "In Progress";
        $allevents->assignee = $username;
        $allevents->team = $userteam;
        $allevents->save();

        Log::insert([
            'progress' => $allevents->progress,
            'method' => $allevents->method,
            'nga_ticket_nr' => $allevents->nga_ticket_nr,
            'old_assignee' => $log->new_assignee,
            'new_assignee' => $username,
            'old_team' => $log->new_team,
            'new_team' => $userteam,
            'start_task_time' => $nowdate,
            'ticketid' => $id
        ]);

        return back()->with(['message' => 'Ticket ' . $id . ' reopened']);
    }

    public function getClearDatabase()
    {
        Allevents::truncate();
        Log::truncate();
        return back()->with(['message' => 'Database cleared']);
    }


}
