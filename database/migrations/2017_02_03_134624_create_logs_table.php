<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('progress');
            $table->string('method')->nullable();
            $table->string('nga_ticket_nr')->nullable();
            $table->string('old_team')->nullable();
            $table->string('new_team')->nullable();
            $table->string('old_assignee');
            $table->string('new_assignee');
            $table->dateTime('start_task_time');
            $table->integer('ticketid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
