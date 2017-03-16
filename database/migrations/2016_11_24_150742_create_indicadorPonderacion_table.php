<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadorPonderacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('indicador_ponderacion', function (Blueprint $table) {
            $table->integer('ponderacion')->default(0);
            $table->integer('ponderacion_id')->unsigned();
            $table->integer('indicador_id')->unsigned();
            $table->engine = 'InnoDB';
        });

        Schema::table('indicador_ponderacion', function ($table) {
            $table->primary(['ponderacion_id','indicador_id']);
            $table->foreign('ponderacion_id')->references('id')->on('ponderaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('indicador_id')->references('id')->on('indicadores')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('indicador_ponderacion');
    }
}
