<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class TipoUsuarioSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        DB::table('tipo_usuarios')->insert(['nombre' => 'Administrador']);
        DB::table('tipo_usuarios')->insert(['nombre' => 'Empleado']);
    }
}
