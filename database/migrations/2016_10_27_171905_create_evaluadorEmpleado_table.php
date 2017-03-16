<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluadorEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //
        Schema::create('evaluador_empleados', function (Blueprint $table) {
            $table->string('empleado_id',10);
            $table->integer('evaluador_id')->unsigned();
            $table->engine = 'InnoDB';

        });

         Schema::table('evaluador_empleados', function ($table) {
            $table->primary(['empleado_id','evaluador_id']);
            $table->foreign('empleado_id')->references('codigo')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evaluador_id')->references('id')->on('evaluadores')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('evaluador_empleados');
    }
}