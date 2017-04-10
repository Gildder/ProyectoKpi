<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaErroresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_errores', function (Blueprint $table) {
            $table->integer('errorop_id')->unsigned();
            $table->integer('tarea_id')->unsigned();
            $table->char('estadoNota',1);
            $table->string('descripcion',120);
            $table->string('empleado_id',10);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::table('nota_errores', function ($table) {
            $table->primary(['errorop_id','tarea_id']);
            $table->foreign('errorop_id')->references('id')->on('error_operaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empleado_id')->references('codigo')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nota_errores');
    }
}
