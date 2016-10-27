<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('empleado', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->primary('id');
            $table->string('nombre',50);
            $table->string('apellidoPaterno',50);
            $table->string('apellidoMaterno',50);
            $table->string('correo',50);
            $table->char('estado',1);
            $table->integer('departamento_id');
            $table->integer('localizacion_id');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->engine = 'InnoDB';

        });

         Schema::table('empleado', function ($table) {
            $table->foreign('departamento_id')->references('id')->on('departamento')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('empleado');
    }
}
