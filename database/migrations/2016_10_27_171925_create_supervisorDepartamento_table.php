<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorDepartamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('supervisor_departamentos', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('departamento_id')->unsigned();
            $table->engine = 'InnoDB';

        });

         Schema::table('supervisor_departamentos', function ($table) {
            $table->primary(['user_id','departamento_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('supervisor_departamentos');
    }
}
