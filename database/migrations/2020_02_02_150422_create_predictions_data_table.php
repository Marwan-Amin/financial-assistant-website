<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredictionsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predictions_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('prediction_id');
            $table->foreign('prediction_id')->references('id')->on('predictions')->onDelete('cascade');
            $table->integer('predication_x');
            $table->integer('predication_y');
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
        Schema::dropIfExists('predictions_data');
    }
}
