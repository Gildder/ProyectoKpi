<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('supervisor_cargos', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('cargo_id')->unsigned();
            $table->engine = 'InnoDB';

        });

         Schema::table('supervisor_cargos', function ($table) {
            $table->primary(['user_id','cargo_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('supervisor_cargos');
    }
}
