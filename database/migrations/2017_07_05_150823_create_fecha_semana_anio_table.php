<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFechaSemanaAnioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fecha_semana_anio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anio')->unsigned();
            $table->integer('mes')->unsigned();
            $table->integer('semana')->unsigned();
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->integer('tipo_semana')->unsigned(); // 0: semana 1 : mes
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fecha_semana_anio');
    }
}
