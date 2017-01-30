<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadorvariableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicador_variables', function (Blueprint $table) {
            $table->integer('indicador_id')->unsigned();
            $table->integer('variable_id')->unsigned();
            $table->timestamps();
        });

         Schema::table('indicador_variables', function ($table) {
            $table->primary(['indicador_id','variable_id']);
            $table->foreign('indicador_id')->references('id')->on('indicadores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('variable_id')->references('id')->on('variables')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('indicador_variables');
    }
}
