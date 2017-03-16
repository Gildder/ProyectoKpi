<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('supervisor_empleados', function (Blueprint $table) {
            $table->string('supervisor_id',10);
            $table->string('empleado_id',10);
            $table->engine = 'InnoDB';

        });

         Schema::table('supervisor_empleados', function ($table) {
            $table->primary(['supervisor_id','empleado_id']);
            $table->foreign('supervisor_id')->references('codigo')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
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
        //
        Schema::drop('supervisor_empleados');
    }
}
