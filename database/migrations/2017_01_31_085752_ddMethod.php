<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DdMethod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ddMethod', function (Blueprint $table) {
            $table->string('method', 200);
        });

        DB::table('ddMethod')->insert(
            array(
                [
                    'method' => 'myHR',
                ],
                [
                    'method' => 'NGA Ticket with form',
                ],
                [
                    'method' => 'NGA Ad\'hoc Ticket',
                ],
                [
                    'method' => 'No Update in MyHR',
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ddMethod');
    }
}
