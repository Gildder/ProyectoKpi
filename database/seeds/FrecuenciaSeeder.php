<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class FrecuenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        DB::table('frecuencias')->insert(['nombre' => 'Semanal']);
        DB::table('frecuencias')->insert(['nombre' => 'Mensual']);
        DB::table('frecuencias')->insert(['nombre' => 'Anual']);
    }
}
