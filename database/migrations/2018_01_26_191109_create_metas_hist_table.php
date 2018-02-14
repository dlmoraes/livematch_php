<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetasHistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas_hist', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meta_id')->nullable()->unsigned();
            $table->foreign('meta_id')->references('id')->on('metas');
            $table->integer('ano_mes_id')->nullable()->unsigned();
            $table->foreign('ano_mes_id')->references('id')->on('ano_mes');
            $table->double('vlr_meta',15,2)->nullable();
            $table->double('vlr_real',15,2)->nullable();
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
        Schema::dropIfExists('metas_hist');
    }
}
