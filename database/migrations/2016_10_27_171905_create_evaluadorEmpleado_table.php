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
            $table->integer('user_id')->unsigned();
            $table->integer('evaluador_id')->unsigned();
            $table->engine = 'InnoDB';

        });

         Schema::table('evaluador_empleados', function ($table) {
            $table->primary(['user_id','evaluador_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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