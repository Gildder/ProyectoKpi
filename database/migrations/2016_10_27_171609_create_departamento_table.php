<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('departamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',120)->unique();
            $table->char('estado',1)->default('1');
            $table->integer('grupodep_id')->unsigned();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->engine = 'InnoDB';
        });

        Schema::table('departamentos', function ($table) {
            $table->foreign('grupodep_id')->references('id')->on('grupo_departamentos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('departamentos');
        
    }
}
