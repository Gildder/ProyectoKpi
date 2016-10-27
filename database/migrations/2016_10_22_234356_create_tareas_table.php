<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tareas', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->primary('id');
            $table->string('descripcion',120);
            $table->dateTime('fechaInicioEstimado');
            $table->dateTime('fechaFinEstimado');
            $table->dateTime('fechaInicioEjecucion');
            $table->dateTime('fechaFinEjecucion');
            $table->time('tiempoEstimado');
            $table->time('tiempoEjecucion');
            $table->integer('estado');
            $table->integer('tipo');
            $table->integer('usuario_id');
            $table->integer('proyecto_id');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->engine = 'InnoDB';
        });

         Schema::table('tareas', function ($table) {
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('tareas');
    }
}
