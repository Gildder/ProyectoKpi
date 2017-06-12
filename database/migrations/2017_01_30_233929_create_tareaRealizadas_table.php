<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareaRealizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarea_localizacion', function (Blueprint $table) {
            $table->integer('tarea_id')->unsigned();
            $table->integer('localizacion_id')->unsigned();
            $table->engine = 'InnoDB';
        });

        Schema::table('tarea_localizacion', function ($table) {
            $table->primary(['tarea_id','localizacion_id']);
            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('localizacion_id')->references('id')->on('localizaciones')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tarea_localizacion');
    }
}
