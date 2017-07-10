<?php

use Illuminate\Database\Seeder;

class EstadoTareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_tareas')->insert(['nombre' => 'Abierto','descripcion' => 'Tarea programada','color' => '#ff3300']);
        DB::table('estado_tareas')->insert(['nombre' => 'En Proceso','descripcion' => 'Tarea avanzado algo','color' => '#ffcc00']);
        DB::table('estado_tareas')->insert(['nombre' => 'Pendiente','descripcion' => 'Tarea programada','color' => '#ff6633']);
        DB::table('estado_tareas')->insert(['nombre' => 'No realizado','descripcion' => 'Tarea sin realizar','color' => '#996633']);
    }
}
