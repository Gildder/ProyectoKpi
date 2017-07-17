<?php 
namespace ProyectoKpi\Cms\Repositories;

use DebugBar\DebugBar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Mockery\CountValidator\Exception;
use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\CalcularSemana;

class TareaRepository
{

    /*contructores */
    public function __construct()
    {
    }

    /* Metodos */
    public static function getTareasProgramadas()
    {
        // Obtenemos las semanas de tareas
        $semanaActual = \Calcana::getSemanasProgramadas(date('Y-m-d'));

        $tareas = Tarea::select('tareas.id', 'tareas.descripcion', 'tareas.fechaInicioEstimado', 'tareas.fechaFinEstimado', 'tareas.tiempoEstimado', 'tareas.fechaInicioSolucion', 'tareas.fechaFinSolucion', 'tareas.tiempoSolucion',
                        'tareas.observaciones', 'tareas.estadoTarea_id', 'tareas.isError', 'tarea_tipos.nombre as tipo', 'tareas.proyecto_id')
//                    ->leftjoin('estado_tareas', 'estado_tareas.id','=', 'tareas.estadoTarea_id')
                    ->leftjoin('tarea_tipos', 'tarea_tipos.id','=', 'tareas.tipoTarea_id')
                    ->where('user_id', '=', \Usuario::get('id'))
                    ->where('fechaInicioEstimado', '>=', $semanaActual->getDateDB('fechaInicio'))
                    ->whereNull('tareas.deleted_at')
                    ->orderBy('tareas.fechaInicioEstimado', 'desc')
                    ->get();

        return $tareas;
    }

    public static function getTareasArchivados()
    {
        try{

            // Obtenemos las semanas de tareas
            $semanaActual = \Calcana::getSemanasProgramadas(date('Y-m-d'));

            $tareas = Tarea::where('user_id', '=', \Usuario::get('id'))
                            ->where('fechaFinEstimado', '<', $semanaActual->getDateDB('fechaInicio'))
                            ->whereOr('fechaFinEstimado', '>', $semanaActual->getDateDB('fechaInicio'))
                            ->whereNull('tareas.deleted_at')
                            ->get();
            return $tareas;
        }catch (Exception $e){
            DebugBar::error('Error: '.$e.', getTareasArchivadas');
        }
    }

    public static function getDiaLimiteEliminar()
    {
        $dia = \DB::table('preferencias')->where('preferencias.id','=', 1)->select('preferencias.diaLimiteBorrarTarea')->first();
        $resultado = 0;

        if($dia->diaLimiteBorrarTarea >= date("N")){
            $resultado = 1;
        }else{
            $resultado = 0;
        }

        // actualizamos opciones de borones
        DB::table('opcion_botones')
            ->where('id', 1)
            ->update(['estado' => $resultado]);

        return $resultado;
    }


    public function getTareasEliminados()
    {
        $tareas = Tarea::where('user_id', '=', \Usuario::get('id'))
                        ->whereNotNull('tareas.deleted_at')
                        ->get();

        return $tareas;
    }

    public static function getSemanasTareas($fecha)
    {
        $fechas =   \DB::select('call pa_obtenerFechaSemanaAnual(\''.$fecha.'\');');

        return $fechas[0];

    }

    public static  function importarTicketAbiertos($fechaInicio, $fechaFin)
    {
        try {

            $client = new GuzzleHttpClient();

            $apiRequest = $client->request('GET', "http://172.17.0.32:8081/api-whd/public/api/ticketAbiertos/'".$fechaInicio."'/'".$fechaFin."'");

            $content = json_decode($apiRequest->getBody()->getContents());

        } catch (RequestException $re) {
            //For handling exception
        }
    }

    public static function importarTicketCerrados($fechaInicio, $fechaFin)
    {
        try {

            $client = new GuzzleHttpClient();

            $apiRequest = $client->request('GET', "http://172.17.0.32:8081/api-whd/public/api/ticketCerrados/'".$fechaInicio."'/'".$fechaFin."'");

            $content = json_decode($apiRequest->getBody()->getContents());

        } catch (RequestException $re) {
            //For handling exception
        }
    }

    public static function insetarTicketsEficacia($ticketsAbiertos, $ticketsCerrados, $anio, $mes, $semana, $user_id)
    {
        try
        {
            \DB::select("call pa_eficacia_insertarTicket(".$ticketsAbiertos.", ".$ticketsCerrados.", ".$anio.", ".$mes.", ".$semana.", ".$user_id." );");

            return 'true';
        }catch (\Exception $errr){
            return 'false';
        }

    }

    public static function cachear($clave, $valor)
    {
            \Cache::forget($clave);
            \Cache::forever($clave, $valor);
    }
}
