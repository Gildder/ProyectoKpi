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
        
        DB::table('cargos')->insert(['nombre' => 'GERENTE DE ADMINISTRACIÓN']);
        DB::table('cargos')->insert(['nombre' => 'ENCARGADO DE SEGURIDAD']);
        DB::table('cargos')->insert(['nombre' => 'GUARDIAS']);
        DB::table('cargos')->insert(['nombre' => 'ASISTENTE DE ADMINISTRACIÓN']);
        DB::table('cargos')->insert(['nombre' => 'MANTENIMIENTO']);
        DB::table('cargos')->insert(['nombre' => 'AUXILIAR DE OFICINA']);
        DB::table('cargos')->insert(['nombre' => 'RECEPCIONISTA SECRETARIA']);
        DB::table('cargos')->insert(['nombre' => 'SUBGERENTE DE SISTEMAS']);
        DB::table('cargos')->insert(['nombre' => 'ASISTENTE DE SOPORTE TÉCNICO']);
        DB::table('cargos')->insert(['nombre' => 'ASISTENTE DE INFRAESTRUCTURA.']);
        DB::table('cargos')->insert(['nombre' => 'ASISTENTE DE INFRAESTRUCTURA JUNIOR']);
        DB::table('cargos')->insert(['nombre' => 'ASISTENTE DE APLICACIONES']);
        DB::table('cargos')->insert(['nombre' => 'ASISTENTE DE APLICACIONES JUNIOR']);
        DB::table('cargos')->insert(['nombre' => 'JEFE DE TALLER']);
        DB::table('cargos')->insert(['nombre' => 'ASISTENTE DE TALLER']);
        DB::table('cargos')->insert(['nombre' => 'ARMADOR DE TALLER']);
        DB::table('cargos')->insert(['nombre' => 'AUXILIAR DE ARMADO']);
        DB::table('cargos')->insert(['nombre' => 'AUXILIAR DE TALLER']);
        DB::table('cargos')->insert(['nombre' => 'INSTALADOR']);
        DB::table('cargos')->insert(['nombre' => 'OPERADOR DE MÁQUINA']);
    }
}
