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
            $table->integer('user_id')->unsigned();
            $table->integer('supervisor_id')->unsigned();

            $table->engine = 'InnoDB';

        });

         Schema::table('supervisor_empleados', function ($table) {
            $table->primary(['supervisor_id','user_id']);
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
