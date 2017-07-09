<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadoTareaSeeder::class);
//        $this->call(FrecuenciaSeeder::class);
//        $this->call(TipoIndicadorSeeder::class);
//        $this->call(CargoSeeder::class);
//        $this->call(LocalizacionSeeder::class);
//        $this->call(TipoUsuarioSeeder::class);
//        $this->call(UserSeeder::class);
//        $this->call(DepartamentoSeeder::class);2016_10_27_171831_
    }
}
