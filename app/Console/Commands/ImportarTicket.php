<?php

namespace ProyectoKpi\Console\Commands;

use Illuminate\Console\Command;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Cms\Repositories\TareaRepository;

class ImportarTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whd:importar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando importa los ticket totales de los tecnicos';

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
        $fechaDeSemana = TareaRepository::getSemanasTareas(date(now()));

        // obtener los respuesta como un array
//        $resultado = $this->argument();

        // recuperando una opcion especifica, si la opcion no existe devolvera nulo
//        $queueName = $this->option('queue');

        // lista  total de tickets abiertos por tecnicos y cantidad de ticket
        $ticketAbiertos = TareaRepository::importarTicketAbiertos($fechaDeSemana->fechaInicio, $fechaDeSemana->fechaFin);

        // lista  total de tickets cerradods por tecnicos y cantidad de ticket
        $ticketCerrados = TareaRepository::importarTicketCerrados($fechaDeSemana->fechaInicio, $fechaDeSemana->fechaFin);

        foreach ($ticketAbiertos as $ticket){
            $user_id = \DB::table('users')->where('users.tecnico_id', $ticket->tecnico_id)->select('users.id')->first();

            // Buscamo los tickets cerrados del tecnico abierto del ticket actual
            $cerrado = array_search($ticket->tecnico_id, array_column($ticketCerrados, 'tecnico_id'));

            $resultado = TareaRepository::insetarTicketsEficacia($ticket->abierto, $cerrado->solucionado, $fechaDeSemana->anio, $fechaDeSemana->mes, $fechaDeSemana->semana);

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
