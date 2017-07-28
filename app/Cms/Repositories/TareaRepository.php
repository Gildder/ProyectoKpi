<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;
use ProyectoKpi\Models\Tareas\Tarea;

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
                    ->leftjoin('tarea_tipos', 'tarea_tipos.id','=', 'tareas.tipoTarea_id')
                    ->where('user_id', '=', \Usuario::get('id'))
                    ->where('fechaInicioEstimado', '>=', $semanaActual->getDateDB('fechaInicio'))
                    ->whereNull('tareas.deleted_at')
                    ->orderBy('tareas.fechaInicioEstimado', 'desc')
                    ->get();

        return $tareas;
    }


    public static function getTareasProgramadasUsuario($usuario_id, $fechaInicio, $fechaFin)
    {
        $tareas = Tarea::select('users.id as user_id','users.nombres', 'users.apellidos' ,'tareas.id', 'tareas.descripcion', 'tareas.fechaInicioEstimado', 'tareas.fechaFinEstimado', 'tareas.tiempoEstimado', 'tareas.fechaInicioSolucion', 'tareas.fechaFinSolucion', 'tareas.tiempoSolucion',
            'tareas.observaciones', 'tareas.estadoTarea_id', 'tareas.isError', 'tarea_tipos.nombre as tipo', 'tareas.proyecto_id')
            ->leftjoin('tarea_tipos', 'tarea_tipos.id','=', 'tareas.tipoTarea_id')
            ->join('users', 'users.id','=', 'tareas.user_id')
            ->where('user_id', '=', $usuario_id)
            ->where('fechaInicioEstimado', '>=', $fechaFin)
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
            ->update(['visible' => $resultado]);

        return $resultado;
    }

    public static function getTareasSupervisados($fechaInicio, $fechaFin)
    {

        $usuarios = \DB::select('call pa_supervisores_empleadosSupervisadosEmpleado('.\Usuario::get('id').');');

        $lista = array();
        foreach ($usuarios as $usuario){
            $resultado = self::getTareasProgramadasUsuario($usuario->id, $fechaInicio, $fechaFin);

            foreach ($resultado as $item) {
                array_push($lista, $item);
            }
        }

        return $lista;
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

    public static  function importarTickets($fechaInicio, $fechaFin)
    {
        try {

            $client = new  \GuzzleHttp\Client();

//            $apiRequest = $client->request('POST', "http://172.17.0.32:8081/api-whd/public/api/ticketAbiertos/'".$fechaInicio."'/'".$fechaFin."'");
            $apiRequest = $client->request('POST', "http://localhost:2000/api/ticketsAbiertosCerrados/'".$fechaInicio."'/'".$fechaFin."'");

            $content = json_decode($apiRequest->getBody()->getContents());

        } catch (RequestException $re) {
            //For handling exception
        }

        return $content;
    }

    public static function insetarTicketsEficacia($ticketsAbiertos, $ticketsCerrados, $anio, $mes, $semana, $fechaInicio, $fechaFin, $user_id)
    {
        try
        {
            \DB::select("call pa_eficacia_insertarTicket(".$ticketsAbiertos.", ".$ticketsCerrados.", ".$anio.", ".$mes.", ".$semana.", '".$fechaInicio."', '".$fechaFin."', ".$user_id." );");

            return 'true';
        }catch (\Exception $errr){
            Log::error('No importaron los usuarios en la tabla de eficacion');
            return 'false';
        }

    }

    public static function cachear($clave, $valor)
    {
            \Cache::forget($clave);
            \Cache::forever($clave, $valor);
    }

    public function preferenciasUsuario($user_id)
    {
        try{
            $usuario = \DB::table('users')->where('id', '=', $user_id)->first();



            if(! isset($usuario->cargo_id))
            {
                return 0;
            }else{

            }
        }catch (\Exception $errr){
            return 'false';
        }
    }
}
