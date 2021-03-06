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
        Schema::create('localizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',20)->unique();
            $table->string('direccion',20);
            $table->string('telefono',20)->unique();
            $table->integer('grupoloc_id')->unsigned();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';

        });

         Schema::table('localizaciones', function ($table) {
            $table->foreign('grupoloc_id')->references('id')->on('grupo_localizaciones')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('localizaciones');
    }
}
