<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscalaPonderacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escala_ponderacion', function (Blueprint $table) {
            $table->integer('minimo')->unsigned();
            $table->integer('maximo')->unsigned();
            $table->integer('ponderacion_id')->unsigned();
            $table->integer('escala_id')->unsigned();
            $table->engine = 'InnoDB';
        });

        Schema::table('escala_ponderacion', function ($table) {
            $table->primary(['ponderacion_id','escala_id']);
            $table->foreign('ponderacion_id')->references('id')->on('ponderaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('escala_id')->references('id')->on('escalas_cumplimiento')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('escala_ponderacion');
    }
}
