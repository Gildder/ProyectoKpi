<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class LocalizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        /* Grupo Localizaciones */

        $id_cb =   DB::table('grupo_localizaciones')->insertGetId(['nombre' => 'Cochabamba']);
        $id_lp =   DB::table('grupo_localizaciones')->insertGetId(['nombre' => 'La Paz']);
        $id_or =   DB::table('grupo_localizaciones')->insertGetId(['nombre' => 'Oruro']);
        $id_sc =   DB::table('grupo_localizaciones')->insertGetId(['nombre' => 'Santa Cruz']);

        /* Localizaciones */

        DB::table('localizaciones')->insert([
            'nombre' => 'Cochabamba', 
            'direccion' => 'Los Claveles', 
            'telefono' => $faker->unique()->tollFreePhoneNumber(),
            'grupoloc_id'=> $id_cb
        ]);
        
        DB::table('localizaciones')->insert([
            'nombre' => 'La Paz', 
            'direccion' => 'Los Claveles', 
            'telefono' => $faker->unique()->tollFreePhoneNumber(),
            'grupoloc_id'=> $id_lp
        ]);
        
        DB::table('localizaciones')->insert([
            'nombre' => 'Oruro', 
            'direccion' => 'Los Claveles', 
            'telefono' => $faker->unique()->tollFreePhoneNumber(),
            'grupoloc_id'=> $id_or
        ]);
        
        DB::table('localizaciones')->insert([
            'nombre' => 'KM 10', 
            'direccion' => 'Los Claveles', 
            'telefono' => $faker->unique()->tollFreePhoneNumber(),
            'grupoloc_id'=> $id_sc
        ]);
        
        DB::table('localizaciones')->insert([
            'nombre' => 'KM 9', 
            'direccion' => 'Los Claveles', 
            'telefono' => $faker->unique()->tollFreePhoneNumber(),
            'grupoloc_id'=> $id_sc
        ]);
        
        DB::table('localizaciones')->insert([
            'nombre' => 'KM 6', 
            'direccion' => 'Los Claveles', 
            'telefono' => $faker->unique()->tollFreePhoneNumber(),
            'grupoloc_id'=> $id_sc
        ]);
        
        DB::table('localizaciones')->insert([
            'nombre' => 'Las Brisas', 
            'direccion' => 'Los Claveles', 
            'telefono' => $faker->unique()->tollFreePhoneNumber(),
            'grupoloc_id'=> $id_sc
        ]);
        
        DB::table('localizaciones')->insert([
            'nombre' => 'Ind. Brasil', 
            'direccion' => 'Los Claveles', 
            'telefono' => $faker->unique()->tollFreePhoneNumber(),
            'grupoloc_id'=> $id_sc
        ]);
        
        DB::table('localizaciones')->insert([
            'nombre' => 'Norte', 
            'direccion' => 'Los Claveles', 
            'telefono' => $faker->unique()->tollFreePhoneNumber(),
            'grupoloc_id'=> $id_sc
        ]);
        
        DB::table('localizaciones')->insert([
            'nombre' => 'Sur', 
            'direccion' => 'Los Claveles', 
            'telefono' => $faker->unique()->tollFreePhoneNumber(),
            'grupoloc_id'=> $id_sc
        ]);
        
        DB::table('localizaciones')->insert([
            'nombre' => 'Oeste', 
            'direccion' => 'Los Claveles', 
            'telefono' => $faker->unique()->tollFreePhoneNumber(),
            'grupoloc_id'=> $id_sc
        ]);
        
    
         /* Grupo Departamento */

        $id_adm =   DB::table('grupo_departamentos')->insertGetId(['nombre' => 'Administracion']);
        $id_sis =   DB::table('grupo_departamentos')->insertGetId(['nombre' => 'Sistemas']);
        $id_asi =   DB::table('grupo_departamentos')->insertGetId(['nombre' => 'Asistentes']);

            /* Departamento */
            
            DB::table('departamentos')->insert(['nombre' => 'Axiliares','grupodep_id'=> $id_asi]);
            DB::table('departamentos')->insert(['nombre' => 'Jefes','grupodep_id'=> $id_adm]);
            DB::table('departamentos')->insert(['nombre' => 'Sistemas','grupodep_id'=> $id_sis]);
            DB::table('departamentos')->insert(['nombre' => 'Asistentes','grupodep_id'=> $id_adm]);
            DB::table('departamentos')->insert(['nombre' => 'Seguridad','grupodep_id'=> $id_adm]);
            DB::table('departamentos')->insert(['nombre' => 'Taller','grupodep_id'=> $id_adm]);
        
    }
}
