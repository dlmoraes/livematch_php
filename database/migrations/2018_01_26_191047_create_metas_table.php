<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empresa_id')->nullable()->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->integer('distrital_id')->nullable()->unsigned();
            $table->foreign('distrital_id')->references('id')->on('distritals');
            $table->integer('regional_id')->nullable()->unsigned();
            $table->foreign('regional_id')->references('id')->on('regionals');
            $table->integer('indicador_id')->nullable()->unsigned();
            $table->foreign('indicador_id')->references('id')->on('indicadores');
            $table->enum('unidade',['Pontos','Qtde','R$','R$M','R$MM','%'])->nullable();
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
        Schema::dropIfExists('metas');
    }
}
