<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CutOffsController extends Controller
{    public function phpgridAllCutoffs(){
    include(app_path() . '/Classes/phpgrid/jqgrid_dist.php');

    include (app_path() . '/Classes/phpgrid/connect.php');

    $g = new \jqgrid($db_conf);
    $opt["toolbar"] = "none";
    $opt["caption"] = "Cut-Offs";
    $opt["height"] = "";
    $opt["multiselect"] = false;
    $opt["sortname"] = "date";
    $opt["sortorder"] = "desc";

    $g->set_options($opt);
    $g->table = "cutoffs";

    $coe = array();
    $coe["title"] = "ID";
    $coe["name"] = "id";
    $coe["hidden"] = True;
    $coe["editable"] = false;
    $coes[] = $coe;

    $coe = array();
    $coe["title"] = "Pay Group Name";
    $coe["name"] = "paygroup";
    $coe["width"] = "300px";
    $coe["align"] = "center";
    $coe["hidden"] = false;
    $coe["editable"] = false;
    $coes[] = $coe;

    $coe = array();
    $coe["title"] = "Cut-off date";
    $coe["name"] = "date";
    $coe["width"] = "200px";
    $coe["align"] = "center";
    $coe["hidden"] = false;
    $coe["editable"] = true;
    $coe["editable"] = true;
    $coe["formatter"] = "date";
    $coe["formatoptions"] = array("srcformat"=>'Y-m-d',"newformat"=>'Y-m-d', "opts" => array("changeYear" => true, "dateFormat"=>'yy-mm-dd', "minDate"=>"15-07-08"));
    $coes[] = $coe;

    $coe = array();
    $coe["title"] = "Edit";
    $coe["name"] = "act";
    $coe["width"] = "70";
    $coe["align"] = "center";
    $coe["hidden"] = false;
    $coes[] = $coe;

    $g->set_columns($coes);

    $g->set_actions(array(
            "add"=>false, // allow/disallow add
            "edit"=>true, // allow/disallow edit
            "delete"=>false, // allow/disallow delete
            "rowactions"=>false, // show/hide row wise edit/del/save option
            "export"=>false, // show/hide export to excel option
            "autofilter" => true, // show/hide autofilter for search
            "search" => "simple", // show single/multi field search condition (e.g. simple or advance)
            "rowactions"=>true
        )
    );

    $out = $g->render("cutoffs");
    return view('cutoffs', array('cutoffs_output' => $out));
}

}
