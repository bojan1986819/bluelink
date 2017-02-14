<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cutoffs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cutoffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('paygroup')->nullable();
            $table->date('date')->nullable();
        });

        DB::table('cutoffs')->insert(
            array([
                'paygroup' => 'AUT - Austria Monthly - EUR',
                'date' => '2017-01-31'
            ],
                [
                    'paygroup' => 'CZE - Czech Republic Monthly - CZK',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'DNK - Denmark Monthly - DKK',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'FIN - Finland Monthly - EUR',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'FRA - France Monthly - EUR',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'DEU - Germany Monthly - EUR',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'GRC - Greece Monthly - EUR',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'HUN - Hungary Monthly - HUF',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'ITA - Italy Monthly - EUR',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'NOR - Norway Monthly - NOK',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'POL - Poland - SellCo - Monthly - PLN',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'POL - Poland - SSC - Monthly - PLN',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'PRT - Portugal Monthly - EUR',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'ROU - Romania Monthly - RON',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'SVK - Slovakia Monthly - EUR',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'SVN - Slovenia Monthly - EUR',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'ESP - Spain Monthly - EUR',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'SWE - Sweden Monthly - SEK',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'CHE - Switzerland Monthly - CHF',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'IRL - Ireland Monthly - EUR',
                    'date' => '2017-01-31'
                ],
                [
                    'paygroup' => 'GBR - United Kingdom Monthly - GBP',
                    'date' => '2017-01-31'
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
        Schema::dropIfExists('cutoffs');
    }
}
