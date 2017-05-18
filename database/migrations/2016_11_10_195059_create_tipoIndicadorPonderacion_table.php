<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoIndicadorPonderacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_ponderaciones', function (Blueprint $table) {
            $table->integer('ponderacion')->default(0);
            $table->integer('ponderacion_id')->unsigned();
            $table->integer('tipoIndicador_id')->unsigned();
            $table->engine = 'InnoDB';
        });

        Schema::table('tipo_ponderaciones', function ($table) {
            $table->primary(['ponderacion_id','tipoIndicador_id']);
            $table->foreign('ponderacion_id')->references('id')->on('ponderaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipoIndicador_id')->references('id')->on('tipos_indicadores')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipo_ponderaciones');
    }
}
