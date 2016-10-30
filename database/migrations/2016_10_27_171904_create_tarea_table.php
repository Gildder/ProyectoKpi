<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tareas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion',120);
            $table->dateTime('fechaInicioEstimado');
            $table->dateTime('fechaFinEstimado');
            $table->dateTime('fechaInicioReal');
            $table->dateTime('fechaFinReal');
            $table->double('tiempoTrabajo',15,2);
            $table->double('tiempoTrabajoReal',15,2);
            $table->text('observacion');
            $table->char('estado',1)->default('1');
            $table->integer('proyecto_id')->unsigned();
            $table->integer('empleado_id');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->engine = 'InnoDB';

        });

         Schema::table('tareas', function ($table) {
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
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
