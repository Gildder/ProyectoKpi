<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('localizacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('direccion',50);
            $table->string('telefono',20);
            $table->string('ciudad',30);
            $table->string('pais',50);
            $table->char('estado',1)->default('1');
            $table->integer('grupoloc_id')->unsigned();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->engine = 'InnoDB';

        });

         Schema::table('localizacion', function ($table) {
            $table->foreign('grupoloc_id')->references('id')->on('grupoLocalizacion')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('localizacion');
    }
}
