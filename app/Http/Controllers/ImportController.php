<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ImportController extends Controller
{
    public function postImportExcel()
	{
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
            $filename = pathinfo(Input::file('import_file')->getClientOriginalName(), PATHINFO_FILENAME);
			$dataall = Excel::load($path, function($reader) {
			})->get();
			$data = Excel::selectSheetByIndex(0)->load();

            $sheetTitle = $data->getTitle();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$insert[] = ['title' => $value->title, 'description' => $value->description];
				}
				if(!empty($insert)){
                    Schema::drop($filename);
                    Schema::create($filename, function (Blueprint $table) {
                        $table->string('title');
                        $table->text('description');
                    });
					DB::table($filename)->insert($insert);
                    dd($filename);
                    return back();
				}
			}
		}
		return back();
	}
}
