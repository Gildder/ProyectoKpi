<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_tareas', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('nombre', 20);
            $table->string('descripcion',120);
            $table->string('color', 7);
            $table->integer('habilitarCalendario')->default(0);
            $table->integer('visiblePorEmpleado')->default(0);
            $table->integer('solucion')->default(0);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
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
        Schema::drop('estado_tareas');

    }
}
