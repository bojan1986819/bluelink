<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DdPayroll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ddPayroll', function (Blueprint $table) {
            $table->string('payrollcompany', 200);
        });

        DB::table('ddPayroll')->insert(
            array(
                [
                    'payrollcompany' => 'AUT - Austria Monthly - EUR',
                ],
                [
                    'payrollcompany' => 'CZE - Czech Republic Monthly - CZK',
                ],
                [
                    'payrollcompany' => 'DNK - Denmark Monthly - DKK',
                ],
                [
                    'payrollcompany' => 'FIN - Finland Monthly - EUR',
                ],
                [
                    'payrollcompany' => 'FRA - France Monthly - EUR',
                ],
                [
                    'payrollcompany' => 'DEU - Germany Monthly - EUR',
                ],
                [
                    'payrollcompany' => 'GRC - Greece Monthly - EUR',
                ],
                [
                    'payrollcompany' => 'HUN - Hungary Monthly - HUF',
                ],
                [
                    'payrollcompany' => 'ITA - Italy Monthly - EUR',
                ],
                [
                    'payrollcompany' => 'NOR - Norway Monthly - NOK',
                ],
                [
                    'payrollcompany' => 'POL - Poland - SellCo - Monthly - PLN',
                ],
                [
                    'payrollcompany' => 'POL - Poland - SSC - Monthly - PLN',
                ],
                [
                    'payrollcompany' => 'PRT - Portugal Monthly - EUR',
                ],
                [
                    'payrollcompany' => 'ROU - Romania Monthly - RON',
                ],
                [
                    'payrollcompany' => 'SVK - Slovakia Monthly - EUR',
                ],
                [
                    'payrollcompany' => 'SVN - Slovenia Monthly - EUR',
                ],
                [
                    'payrollcompany' => 'ESP - Spain Monthly - EUR',
                ],
                [
                    'payrollcompany' => 'SWE - Sweden Monthly - SEK',
                ],
                [
                    'payrollcompany' => 'CHE - Switzerland Monthly - CHF',
                ],
                [
                    'payrollcompany' => 'IRL - Ireland Monthly - EUR',
                ],
                [
                    'payrollcompany' => 'GBR - United Kingdom Monthly - GBP',
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
        Schema::dropIfExists('ddPayroll');
    }
}
