<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluadorIndicadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluador_indicadores', function (Blueprint $table) {
            $table->integer('indicador_id')->unsigned();
            $table->integer('evaluador_id')->unsigned();
            $table->engine = 'InnoDB';

        });

         Schema::table('evaluador_indicadores', function ($table) {
            $table->primary(['indicador_id','evaluador_id']);
            $table->foreign('indicador_id')->references('id')->on('indicadores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evaluador_id')->references('id')->on('_TablaMes')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('evaluador_indicadores');
        //
    }
}
