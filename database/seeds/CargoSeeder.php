<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();
        
        DB::table('cargos')->insert(['nombre' => 'gerente de administracion']);
        DB::table('cargos')->insert(['nombre' => 'encargado de seguridad']);
        DB::table('cargos')->insert(['nombre' => 'guardias']);
        DB::table('cargos')->insert(['nombre' => 'asistente de administracion']);
        DB::table('cargos')->insert(['nombre' => 'mantenimiento']);
        DB::table('cargos')->insert(['nombre' => 'auxiliar de oficina']);
        DB::table('cargos')->insert(['nombre' => 'recepcionista secretaria']);
        DB::table('cargos')->insert(['nombre' => 'subgerente de sistemas']);
        DB::table('cargos')->insert(['nombre' => 'asistente de soporte tecnico']);
        DB::table('cargos')->insert(['nombre' => 'asistente de infraestructura.']);
        DB::table('cargos')->insert(['nombre' => 'asistente de infraestructura junior']);
        DB::table('cargos')->insert(['nombre' => 'asistente de aplicaciones']);
        DB::table('cargos')->insert(['nombre' => 'asistente de aplicaciones junior']);
        DB::table('cargos')->insert(['nombre' => 'jefe de taller']);
        DB::table('cargos')->insert(['nombre' => 'asistente de taller']);
        DB::table('cargos')->insert(['nombre' => 'armador de taller']);
        DB::table('cargos')->insert(['nombre' => 'auxiliar de armado']);
        DB::table('cargos')->insert(['nombre' => 'auxiliar de taller']);
        DB::table('cargos')->insert(['nombre' => 'instalador']);
        DB::table('cargos')->insert(['nombre' => 'operador de máquina']);
    }
}
