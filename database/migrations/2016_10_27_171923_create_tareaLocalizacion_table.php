<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareaLocalizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tareaLocalizacion', function (Blueprint $table) {
            $table->integer('tarea_id');
            $table->integer('localizacion_id');
            $table->primary('tarea_id');
            $table->primary('localizacion_id');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->engine = 'InnoDB';

        });

         Schema::table('tareaLocalizacion', function ($table) {
            $table->foreign('tarea_id')->references('id')->on('tarea')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('localizacion_id')->references('id')->on('localizacion')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('tareaLocalizacion');
    }
}
