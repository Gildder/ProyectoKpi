<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('proyectos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->dateTime('fechaInicioEstimado');
            $table->dateTime('fechaFinEstimado');
            $table->dateTime('fechaInicioReal');
            $table->dateTime('fechaFinReal');
            $table->double('tiempoTrabajo',15,2);
            $table->double('tiempoTrabajoReal',15,2);
            $table->text('observacion');
            $table->char('estado',1);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->engine = 'InnoDB';

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
        Schema::drop('proyectos');
    }
}
