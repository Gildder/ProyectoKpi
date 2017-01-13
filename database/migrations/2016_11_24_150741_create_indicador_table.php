<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',100)->unique();
            $table->integer('orden');
            $table->string('descripcion_objetivo',100);
            $table->double('objetivo');
            $table->string('condicion',120)->default('ninguna');
           // $table->enum('frecuencia',['1','2','3']); //1 semanal, 2 mensual, 3 anual
            $table->integer('frecuencia_id')->unsigned();
            $table->char('estado',1)->default('1');
            $table->integer('tipo_indicador_id')->unsigned();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->engine = 'InnoDB';
        });

        Schema::table('indicadores', function ($table) {
            $table->foreign('tipo_indicador_id')->references('id')->on('tipos_indicadores')->onDelete('cascade')->onUpdate('cascade');
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
        //
        Schema::drop('indicadores');
    }
}
