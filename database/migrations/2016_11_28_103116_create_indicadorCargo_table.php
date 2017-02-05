<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadorCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicador_cargos', function (Blueprint $table) {
            $table->integer('indicador_id')->unsigned();
            $table->integer('cargo_id')->unsigned();
            $table->double('objetivo');
            $table->string('condicion',120);
            $table->string('aclaraciones',120);
            $table->integer('frecuencia_id')->unsigned();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';

        });

         Schema::table('indicador_cargos', function ($table) {
            $table->primary(['indicador_id','cargo_id']);
            $table->foreign('indicador_id')->references('id')->on('indicadores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('frecuencia_id')->references('id')->on('frecuencias')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('indicador_cargos');
        //
    }
}
