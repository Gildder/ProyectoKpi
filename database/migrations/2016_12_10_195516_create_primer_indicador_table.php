<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrimerIndicadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primer_indicador', function(Blueprint $table){
            $table->increments('id');
            $table->integer('gestion');
            $table->integer('mes');
            $table->integer('semana');
            $table->integer('actpro'); //actividades programadas
            $table->integer('actrea'); //actividades realizadas
            $table->double('efeser'); //Eficacia del serivicio
            $table->string('emp_codigo',10); 
            $table->integer('indicador_id')->unsigned();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::table('primer_indicador', function($table) {
            $table->foreign('emp_codigo')->references('codigo')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('primer_indicador');
    }
}
