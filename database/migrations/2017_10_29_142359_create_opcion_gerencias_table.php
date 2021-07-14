<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateOpcionGerenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcion_aprobacion_evaluadores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('opcion_id')->unsigned();
            $table->integer('evaluador_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });


        Schema::table('opcion_aprobacion_evaluadores', function ($table) {
            $table->foreign('opcion_id')->references('id')
                ->on('opcion_aprobaciones')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('evaluador_id')->references('id')
                ->on('evaluadores')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('opcion_aprobacion_evaluadores');
    }
}
