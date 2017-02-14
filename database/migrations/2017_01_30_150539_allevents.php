<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Allevents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allevents', function (Blueprint $table) {
            $table->increments('id');
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
            $table->date('cut_off_date')->nullable();
            $table->string('assignee')->default('Not assigned');
            $table->string('team')->nullable();
            $table->string('progress')->default('Open');
            $table->string('method')->nullable();
            $table->string('nga_ticket_nr')->nullable();
            $table->string('remark')->nullable();
            $table->string('owner')->nullable();
            $table->string('owner_team')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allevents');
    }
}
