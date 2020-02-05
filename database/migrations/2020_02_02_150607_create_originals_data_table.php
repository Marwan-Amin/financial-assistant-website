<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOriginalsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('originals_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('prediction_id');
            $table->foreign('prediction_id')->references('id')->on('predictions')->onDelete('cascade');
            $table->integer('original_x');
            $table->integer('original_y');
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
        Schema::dropIfExists('originals_data');
    }
}
