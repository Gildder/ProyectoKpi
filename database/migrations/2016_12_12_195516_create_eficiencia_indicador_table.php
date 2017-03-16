<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEficienciaIndicadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eficiencia_indicador', function(Blueprint $table){
            $table->increments('id');
            $table->integer('gestion');
            $table->integer('mes');
            $table->integer('semana');
            $table->integer('totope')->default(0); //Total operaciones
            $table->integer('numerr')->default(0);  //numero de errores
            $table->double('efeact')->default(0); //Eficiencia en la actividad
            $table->string('empleado_id',10); 
            $table->integer('indicador_id')->unsigned();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::table('eficiencia_indicador', function($table) {
            $table->foreign('empleado_id')->references('codigo')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('eficiencia_indicador');
    }
}
