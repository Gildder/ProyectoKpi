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
            $table->increments('id');
            $table->integer('numero');
            $table->string('descripcion',60);
            $table->date('fechaInicioEstimado');
            $table->date('fechaFinEstimado');
            $table->time('tiempoEstimado');
            $table->date('fechaInicioSolucion');
            $table->date('fechaFinSolucion');
            $table->time('tiempoSolucion');
            $table->text('observaciones',120);
            $table->integer('estadoTarea_id')->unsigned();
            $table->integer('isError')->default(null);
            $table->integer('tipoTarea_id')->unsigned();; //tareas programadas 1 , tareas diarias 0
            $table->integer('user_id')->unsigned();
            $table->integer('proyecto_id')->unsigned()->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::table('tareas', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('estadoTarea_id')->references('id')->on('estado_tareas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipoTarea_id')->references('id')->on('tarea_tipos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tareas');
    }
}
