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
        
        DB::table('cargos')->insert(['nombre' => 'Gerente de Administracion']);
        DB::table('cargos')->insert(['nombre' => 'Encargado de Seguridad']);
        DB::table('cargos')->insert(['nombre' => 'Guardias']);
        DB::table('cargos')->insert(['nombre' => 'Asistente de Administracion']);
        DB::table('cargos')->insert(['nombre' => 'Mantenimiento']);
        DB::table('cargos')->insert(['nombre' => 'Auxiliar de Oficina']);
        DB::table('cargos')->insert(['nombre' => 'Recepcionista Secretaria']);
        DB::table('cargos')->insert(['nombre' => 'Subgerente de Sistemas']);
        DB::table('cargos')->insert(['nombre' => 'Asistente de Soporte Tecnico']);
        DB::table('cargos')->insert(['nombre' => 'Asistente de Infraestructura.']);
        DB::table('cargos')->insert(['nombre' => 'Asistente de Infraestructura junior']);
        DB::table('cargos')->insert(['nombre' => 'Asistente de Aplicaciones']);
        DB::table('cargos')->insert(['nombre' => 'Asistente de Aplicaciones junior']);
        DB::table('cargos')->insert(['nombre' => 'Jefe de Taller']);
        DB::table('cargos')->insert(['nombre' => 'Asistente de Taller']);
        DB::table('cargos')->insert(['nombre' => 'Armador de Taller']);
        DB::table('cargos')->insert(['nombre' => 'Auxiliar de Armado']);
        DB::table('cargos')->insert(['nombre' => 'Auxiliar de Taller']);
        DB::table('cargos')->insert(['nombre' => 'Instalador']);
        DB::table('cargos')->insert(['nombre' => 'Operador de Máquina']);
    }
}
