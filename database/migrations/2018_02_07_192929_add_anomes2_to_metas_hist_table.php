<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnomes2ToMetasHistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metas_hist', function (Blueprint $table) {
            $table->integer('ano_id')->nullable()->unsigned();
            $table->foreign('ano_id')->references('id')->on('anos');
            $table->integer('mes_id')->nullable()->unsigned();
            $table->foreign('mes_id')->references('id')->on('meses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
