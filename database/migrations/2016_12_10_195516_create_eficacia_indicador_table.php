<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEficaciaIndicadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eficacia_indicador', function(Blueprint $table){
            $table->increments('id');
            $table->integer('gestion');
            $table->integer('mes');
            $table->integer('semana');
            $table->integer('actpro')->default(0); //actividades programadas
            $table->integer('actrea')->default(0);  //actividades realizadas
            $table->double('efeser', 3,2)->default(0); //Eficacia del serivicio
            $table->integer('user_id')->unsigned();
            $table->integer('indicador_id')->unsigned();
            $table->integer('ticket_abiertos')->default(0);
            $table->integer('ticket_cerrados')->default(0);
            $table->double('efeser_ticket', 3,2)->default(0);
            $table->double('efeser_total', 3,2)->default(0);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::table('eficacia_indicador', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('indicador_id')->references('id')->on('indicadores')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('eficacia_indicador');
    }
}
