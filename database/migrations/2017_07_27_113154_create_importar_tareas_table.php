<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportarTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importar_tareas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tecnico');
            $table->string('tareas');
            $table->integer('minutos');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->string('estado');
            $table->string('tienda');
            $table->string('observacion');
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
        Schema::drop('importar_tareas');
    }
}
