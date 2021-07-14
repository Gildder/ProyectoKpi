<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateConexionLdapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conexion_ldap',  function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 20);
            $table->integer('habilitado');
            $table->String('host', 50);
            $table->String('puerto', 10);
            $table->String('dominio', 50);
            $table->String('usuarioConexion', 50);
            $table->String('contasenaConexion', 700);
            $table->String('dn', 50);
            $table->integer('timeout');
            $table->integer('ignorarValoresBlancos');
            $table->integer('diaAutoincronizacion');
            $table->time('horaAutoincronizacion');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conexion_ldap');
    }
}
