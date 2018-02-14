<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicadores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ordem')->unsigned()->nullable();
            $table->string('indicador');
            $table->integer('categoria_id')->nullable()->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->integer('tipo_ind_id')->nullable()->unsigned();
            $table->foreign('tipo_ind_id')->references('id')->on('tipo_ind');
            $table->string('objetivo',100)->nullable();
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
        Schema::dropIfExists('indicadores');
    }
}
