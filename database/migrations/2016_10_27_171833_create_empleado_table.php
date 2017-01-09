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
        Schema::create('empleados', function (Blueprint $table) {
            $table->string('codigo',10)->unique();
            $table->primary('codigo');
            $table->string('nombres',50);
            $table->string('apellidos',50);
            $table->char('estado',1)->default('1');
            $table->integer('grdepartamento_id')->unsigned();
            $table->integer('departamento_id')->unsigned();
            $table->integer('grlocalizacion_id')->unsigned();
            $table->integer('localizacion_id')->unsigned();
            $table->integer('cargo_id')->unsigned();
            $table->integer('user_id')->unique()->unsigned();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->engine = 'InnoDB';

        });

         Schema::table('empleados', function ($table) {
            $table->foreign('grdepartamento_id')->references('id')->on('grupo_departamentos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('grlocalizacion_id')->references('id')->on('grupo_localizaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('localizacion_id')->references('id')->on('localizaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('empleados');
    }
}
