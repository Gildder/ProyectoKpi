<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up()
    {
        Schema::create('evaluadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('abreviatura',10)->unique();
            $table->string('descripcion',40)->unique();
            $table->integer('ponderacion_id')->unsigned();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::table('evaluadores', function ($table) {
            $table->foreign('ponderacion_id')->references('id')
                  ->on('ponderaciones')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('evaluadores');
    }
}
