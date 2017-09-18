<?php

namespace ProyectoKpi\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use ProyectoKpi\Cms\Repositories\UsuarioVacacionRepositorio;
use ProyectoKpi\Models\User;

class ImportarTicketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whd:importarTicket {fecha}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando importará los tickets abiertos y cerrados';

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

        // lista  total de tickets abiertos por tecnicos y cantidad de ticket
        $tickets = TareaRepository::importarTickets($fechaDeSemana->fechaInicio, $fechaDeSemana->fechaFin);
        $usuarios = TareaRepository::EmpleadosDeIndicador(1);


//        dd(\GuzzleHttp\json_encode($tickets), \GuzzleHttp\json_encode($usuarios));
        foreach ($tickets->ticket as $ticket){
            $existe = false;

            // verificamos si el usuario esta asignado el indicador
            foreach ($usuarios as $usuario) {
                if($usuario->id == $ticket->id){
                    $existe = true;
                }
            }
            $isVacacion = UsuarioVacacionRepositorio::isEntreVacacion($fechaDeSemana->fechaInicio, $fechaDeSemana->fechaFin, $ticket->id);

            $resultado = false;
            if($existe){
                $resultado = TareaRepository::insertarTicketsEficacia(
                    $ticket->abiertos,
                    $ticket->resueltos,
                    $fechaDeSemana->anio,
                    $fechaDeSemana->mes,
                    $fechaDeSemana->semana,
                    $fechaDeSemana->fechaInicio,
                    $fechaDeSemana->fechaFin,
                    $ticket->id,
                    $isVacacion
                );


//                dd($ticket->abiertos,
//                    $ticket->resueltos,
//                    $fechaDeSemana->anio,
//                    $fechaDeSemana->mes,
//                    $fechaDeSemana->semana,
//                    $fechaDeSemana->fechaInicio,
//                    $fechaDeSemana->fechaFin,
//                    $ticket->id,
//                    $resultado,
//                    $isVacacion);
            }

            if ($resultado == true){
                $this->info('Se actualizo correctamente');
            }
            else{
                $this->info('No se actualizo correctamente');

                if(!$existe){
                    $this->info('El tecnico '.$ticket->id.' No esta con Indicador');
                }
            }
        }

        // mensaje de informacion
        $this->info('La importacion de los ticket se realizo correctamente.');
    }
}
