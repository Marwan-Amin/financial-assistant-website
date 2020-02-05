<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAmountRangeInBalances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('balances', function (Blueprint $table) {
            $table->decimal('total_expenses',11,2)->change();
            $table->decimal('total_income',11,2)->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('balances', function (Blueprint $table) {
            //
        });
    }
}
