<?php

namespace App\Http\Controllers;

use App\Allevents;
use App\Cutoffs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ImportController extends Controller
{
    private $filename;
    private $wbfilename;
    private $payrollcompany;
    private $badfiles;

    public function postImportExcel()
	{
		if(Input::hasFile('import_file')){
		    $this->badfiles = 'none';
		    $files = Input::file('import_file');
		    foreach ($files as $file) {
                //get file name without extension, if for only one file then use $file = Input::file('import_file')
                $this->filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $path = $file->getRealPath();
                $data = Excel::load($path, function ($reader) {
                });
                //check if file is correct
                Config::set('excel.import.startRow', 1);
                if ($data->first()->getTitle() != "Summary") {
                    //add wrong files name to badfiles list
                    if($this->badfiles != 'none') {
                        $this->badfiles = $this->badfiles . ", " . $file->getClientOriginalName();
                    } else {
                        $this->badfiles = $file->getClientOriginalName();
                    }
                } else {
                    //import
                    Excel::load($path, function ($reader) {
                        //start form 2nd row
                        Config::set('excel.import.startRow', 2);

                        //check if table exists, delete if yes, and create new
                        if (Schema::hasTable('newimport')) {
                            Schema::drop('newimport');
                        }
                        Schema::create('newimport', function (Blueprint $table) {
                            $table->string('payrollcompany')->nullable();
                            $table->string('workday_id')->nullable();
                            $table->string('payroll_id')->nullable();
                            $table->string('name')->nullable();
                            $table->string('effective_moment');
                            $table->string('entry_moment');
                            $table->string('event');
                            $table->string('wdfilename');
                            $table->string('sheet');
                            $table->string('checkingid');
                            $table->dateTime('created_at');
                            $table->date('cut_off_date');
                        });
                        //set value for workbook file name from Summary sheet cells b2&b6
                        $this->wbfilename = $reader->getSheetByName('Summary')->getCell('B2')->getValue() .
                            "_" .
                            $reader->getSheetByName('Summary')->getCell('b6')->getValue();
                        //set value for payroll company from summary sheet cell b1
                        $this->payrollcompany = $reader->getSheetByName('Summary')->getCell('b3')->getValue();

                        $reader->each(function ($sheet) {
                            foreach ($sheet->toArray() as $row) {
                                if ($sheet->getTitle() == "Summary") {
                                    //do nothing
                                } elseif ($sheet->getTitle() == "Worker Events") {
                                    //do nothing
                                } else {
                                    foreach ($sheet as $key => $value) {
                                        $insert[] = ['payrollcompany' => $this->payrollcompany,
                                            'workday_id' => $value->workday_employee_id,
                                            'payroll_id' => $value->payroll_system_id,
                                            'name' => $value->name,
                                            'effective_moment' => $value->effective_moment,
                                            'entry_moment' => $value->entry_moment,
                                            'event' => $value->event,
                                            'wdfilename' => $this->wbfilename,
                                            'sheet' => $sheet->getTitle(),
                                            'checkingid' => $this->payrollcompany . $value->workday_employee_id .
                                                $value->payroll_system_id . $value->name . $value->effective_moment .
                                                $value->entry_moment . $value->event . $this->wbfilename . $sheet->getTitle(),
                                            'created_at' => date("Y-m-d H:i:s"),
                                            'cut_off_date' => Cutoffs::where('paygroup',$this->payrollcompany)->value('date')
                                        ];
                                    }
                                    if (!empty($insert)) {
                                        DB::table('newimport')->insert($insert);
                                        return back();
                                    }
                                }
                            }
                        });
                    })->get();
                    //put new import into an array and add to all events
                    $newiport = DB::table('newimport')
                        ->leftJoin('allevents', function ($join) {
                            $join->on('newimport.checkingid', '=', 'allevents.checkingid');
                        })
                        ->select('newimport.*')
                        ->groupBy('newimport.payrollcompany','newimport.workday_id',
                            'newimport.payroll_id','newimport.name','newimport.effective_moment','newimport.entry_moment',
                            'newimport.event','newimport.wdfilename','newimport.sheet','newimport.checkingid',
                            'newimport.created_at','newimport.cut_off_date')
                        ->whereNull('allevents.checkingid')
                        ->get();
                    $newiport = collect($newiport)->map(function ($x) {
                        return (array)$x;
                    })->toArray();
                    Allevents::insert($newiport);
                }
            }
            return back()->with(['message' => 'Import successfull! Files not imported: '.$this->badfiles]);
        }
        return back()->with(['message' => 'Please select a file!']);
	}
}
