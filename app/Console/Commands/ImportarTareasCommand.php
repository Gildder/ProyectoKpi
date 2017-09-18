<?php

namespace ProyectoKpi\Console\Commands;

use Illuminate\Console\Command;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use ProyectoKpi\Cms\Repositories\UsuarioVacacionRepositorio;

class ImportarTareasCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whd:importarTareas {fecha}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando importará las tareas programadas y realizadas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fechaDeSemana = TareaRepository::getSemanasTareas($this->argument('fecha'));

        // obtener los tareas que se encuestran dentro de las fechas indicadas
        $tareas = TareaRepository::importarTareas($fechaDeSemana->fechaInicio, $fechaDeSemana->fechaFin);
//dd(json_encode($tareas));

        foreach ($tareas as $tarea) {
            // verificamos si tiene vacaciones
            $isVacacion = UsuarioVacacionRepositorio::isEntreVacacion($fechaDeSemana->fechaInicio, $fechaDeSemana->fechaFin, $tarea->user_id);

            $resultado = TareaRepository::insertarTareasEficacia(
                $tarea->programados,
                $tarea->resueltos,
                $fechaDeSemana->anio,
                $fechaDeSemana->mes,
                $fechaDeSemana->semana,
                $fechaDeSemana->fechaInicio,
                $fechaDeSemana->fechaFin,
                $tarea->user_id,
                $isVacacion
            );

            if ($resultado == true){
                $this->info('Se actualizo correctamente');
            }
            else{
                $this->info('No se actualizo correctamente');
            }
        }

        // mensaje de informacion
        $this->info('La importacion de los ticket se realizo correctamente.');
    }
}
