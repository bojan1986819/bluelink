<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DdProgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ddProgress', function (Blueprint $table) {
            $table->string('progress', 200);
        });

        DB::table('ddProgress')->insert(
            array(
                [
                    'progress' => 'Open',
                ],
                [
                    'progress' => 'In Progress',
                ],
                [
                    'progress' => 'In Progress NGA',
                ],
                [
                    'progress' => 'Completed',
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
        Schema::dropIfExists('ddProgress');
    }
}
