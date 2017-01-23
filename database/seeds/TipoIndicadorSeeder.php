<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class TipoIndicadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        DB::table('tipos_indicadores')->insert(['nombre' => 'Procesos']);
        DB::table('tipos_indicadores')->insert(['nombre' => 'Innovacion y Aprendizaje']);
        DB::table('tipos_indicadores')->insert(['nombre' => 'Finanzas']);
        DB::table('tipos_indicadores')->insert(['nombre' => 'Clientes']);
    }
}
