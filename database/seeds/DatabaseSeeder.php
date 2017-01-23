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
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LocalizacionSeeder::class);
        $this->call(FrecienciaSeeder::class);
        $this->call(TipoIndicadorSeeder::class);
        $this->call(CargoSeeder::class);
    }
}
