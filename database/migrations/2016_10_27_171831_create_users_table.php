<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('codigo',10)->unique()->nullable();
            $table->string('nombres',50)->nullable();
            $table->string('apellidos',50)->nullable();
            $table->integer('departamento_id')->unsigned()->nullable();
            $table->integer('localizacion_id')->unsigned()->nullable();
            $table->integer('cargo_id')->unsigned()->nullable();

            $table->string('password', 700);
            $table->string('color', 7)->nullable();
            $table->string('base_dn', 255)->nullable();
            $table->dateTime('last_activity')->nullable();
            $table->integer('active')->default(1);
            $table->integer('ldap_conection_id')->default(0);
            $table->integer('type')->unsigned(); //1 admin, 2 normal
            $table->integer('locked')->unsigned()->default(0);
            $table->integer('hasRelation')->unsigned()->default(0);
            $table->rememberToken();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::table('users', function ($table) {
            $table->foreign('type')->references('id')->on('tipo_usuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('localizacion_id')->references('id')->on('localizaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
