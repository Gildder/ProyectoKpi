<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluadorWidgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluador_widget', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evaluador_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('isSemanal');
            $table->string('titulo', 45);
            $table->integer('mesInicio');
            $table->integer('anio');
            $table->integer('mesBuscado');
            $table->integer('tipoWidget');
            $table->integer('tipoIndicadorWidget');
            $table->integer('indicadorWidget')->nullable()->nullable();
            $table->integer('mesTareaWidget')->nullable();
            $table->integer('semanaTareaWidget')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::table('evaluador_widget', function ($table) {
            $table->foreign('evaluador_id')->references('id')->on('evaluadores');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('evaluador_widget');
    }
}
