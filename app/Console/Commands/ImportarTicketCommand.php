<?php

namespace ProyectoKpi\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Cms\Repositories\TareaRepository;

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
//        $fechaDeSemana = TareaRepository::getSemanasTareas(date('Y-m-d'));

        // obtener los respuesta como un array
//        $resultado = $this->argument();

        // recuperando una opcion especifica, si la opcion no existe devolvera nulo
//        $queueName = $this->option('queue');

        // lista  total de tickets abiertos por tecnicos y cantidad de ticket
        $tickets = TareaRepository::importarTickets($fechaDeSemana->fechaInicio, $fechaDeSemana->fechaFin);


        foreach ($tickets->ticket as $ticket){
//            $this->info(\GuzzleHttp\json_encode($ticket));
            $user_id = \DB::table('users')->where('users.tecnico_id', $ticket->id)->select('users.id')->first();

            $resultado = TareaRepository::insetarTicketsEficacia(
                        $ticket->abiertos,
                        $ticket->resueltos,
                        $fechaDeSemana->anio,
                        $fechaDeSemana->mes,
                        $fechaDeSemana->semana,
                        $fechaDeSemana->fechaInicio,
                        $fechaDeSemana->fechaFin,
                        $user_id
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
