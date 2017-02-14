<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DdTeam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ddTeam', function (Blueprint $table) {
            $table->string('team', 200);
        });
        DB::table('ddTeam')->insert(
            array(
                [
                    'team' => 'HR DM COE',
                ],
                [
                    'team' => 'HR Local - FR',
                ],
                [
                    'team' => 'HR Local - DE',
                ],
                [
                    'team' => 'HR Local - Nordics',
                ],
                [
                    'team' => 'HR Local - AT',
                ],
                [
                    'team' => 'HR Local - CH',
                ],
                [
                    'team' => 'HR Local - ES',
                ],
                [
                    'team' => 'HR Local - IT',
                ],
                [
                    'team' => 'HR Local - PL SellCo',
                ],
                [
                    'team' => 'HR Local - PT',
                ],
                [
                    'team' => 'HR Local - UK',
                ],
                [
                    'team' => 'HR Local - GR',
                ],
                [
                    'team' => 'HR Local - CZ',
                ],
                [
                    'team' => 'HR Local - RO',
                ],
                [
                    'team' => 'HR Local - SK',
                ],
                [
                    'team' => 'HR Local - SI',
                ],
                [
                    'team' => 'HR Local - PL SSC',
                ],
                [
                    'team' => 'HR Local - HU',
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
        Schema::dropIfExists('ddTeam');
    }
}
