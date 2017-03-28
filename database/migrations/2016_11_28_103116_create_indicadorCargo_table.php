<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadorCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicador_cargos', function (Blueprint $table) {
            $table->integer('indicador_id')->unsigned();
            $table->integer('cargo_id')->unsigned();
            $table->integer('evaluadorIndicador_id')->unsigned();
            $table->integer('evaluadorCargo_id')->unsigned();
            $table->double('objetivo');
            $table->string('condicion',120);
            $table->string('aclaraciones',120);
            $table->integer('frecuencia_id')->unsigned();
            $table->engine = 'InnoDB';

        });

         Schema::table('indicador_cargos', function ($table) {
            $table->primary(['indicador_id','evaluadorIndicador_id','cargo_id','evaluadorCargo_id']);

            // evaluador indicador
            $table->foreign('indicador_id')
                    ->references('indicador_id')->on('evaluador_indicadores')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evaluadorIndicador_id')
                    ->references('evaluador_id')->on('evaluador_indicadores')
                    ->onDelete('cascade')->onUpdate('cascade');
            // evaluador cargos
            $table->foreign('evaluadorCargo_id')
                    ->references('evaluador_id')->on('evaluador_cargos')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cargo_id')
                    ->references('cargo_id')->on('evaluador_cargos')
                    ->onDelete('cascade')->onUpdate('cascade');


            $table->foreign('frecuencia_id')->references('id')->on('frecuencias')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('indicador_cargos');
        //
    }
}
