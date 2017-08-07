<?php

namespace ProyectoKpi\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Cms\Repositories\TareaRepository;
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

        foreach ($tickets->ticket as $ticket){
//            $usuario = \DB::table('users')->select('users.id')->where('users.tecnico_id', '=', $ticket->id)->first();
            $usuario = User::where('users.tecnico_id', '=', $ticket->id)->select('users.id as p')->first();

            $this->info(
                $ticket->abiertos.' - '.
                $ticket->resueltos.' - '.
                $fechaDeSemana->anio.' - '.
                $fechaDeSemana->mes.' - '.
                $fechaDeSemana->semana.' - '.
                $fechaDeSemana->fechaInicio.' - '.
                $fechaDeSemana->fechaFin.' - '.
                $ticket->id.' - '.
                $usuario
            );


            $resultado = TareaRepository::insetarTicketsEficacia(
                        $ticket->abiertos,
                        $ticket->resueltos,
                        $fechaDeSemana->anio,
                        $fechaDeSemana->mes,
                        $fechaDeSemana->semana,
                        $fechaDeSemana->fechaInicio,
                        $fechaDeSemana->fechaFin,
                        $usuario
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
