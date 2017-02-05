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
            $table->string('descripcion',60);
            $table->date('fechaInicioEstimado');
            $table->date('fechaFinEstimado');
            $table->time('tiempoEstimado');
            $table->date('fechaInicioSolucion');
            $table->date('fechaFinSolucion');
            $table->time('tiempoSolucion');
            $table->text('observaciones',120);
            $table->char('estado',1);
            $table->integer('tipo');
            $table->string('empleado_id',10);
            $table->integer('proyecto_id')->unsigned()->default(0);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::table('tareas', function ($table) {
            $table->foreign('empleado_id')->references('codigo')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('tareas');
    }
}
