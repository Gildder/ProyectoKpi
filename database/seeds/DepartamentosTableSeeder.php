<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
       for($i=0; $i <5 ; $i++) 
       {

        $id =   DB::table('grupo_departamentos')->insert([
                'nombre' => $faker->unique()->name(),
                'estado' => $faker->numberBetween($min = 0, $max = 1),
            ]);


            DB::table('departamentos')->insert([
                'nombre' => $faker->unique()->name(),
                'estado' => $faker->numberBetween($min = 0, $max = 1),
                'grupodep_id' => $id,
            ]);
       }
        
    }
}
