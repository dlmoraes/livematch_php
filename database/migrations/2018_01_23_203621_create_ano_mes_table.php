<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnoMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ano_mes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ano_id')->unsigned()->nullable();
            $table->foreign('ano_id')->references('id')->on('anos');
            $table->integer('mes_id')->unsigned()->nullable();
            $table->foreign('mes_id')->references('id')->on('meses');
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
        Schema::dropIfExists('ano_mes');
    }
}
