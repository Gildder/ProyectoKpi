<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTicketTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ticket_empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('tecnico_id');
            $table->integer('ticket_abiertos'); 
            $table->integer('ticket_cerrados'); 
            $table->integer('semana_tipo_id')->unsigned();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::table('ticket_empleados', function ($table) {
            $table->foreign('user_id')->references('codigo')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('semana_tipo_id')->references('id')->on('tipo_semanas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ticket_empleados');
    }
}
