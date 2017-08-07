<?php 
namespace ProyectoKpi\Cms\Repositories;

use function dd;
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
        $semanaActual = TareaRepository::getSemanasTareas(date('Y-m-d'));

        $tareas = Tarea::select('tareas.id','tareas.numero', 'tareas.descripcion', 'tareas.fechaInicioEstimado', 'tareas.fechaFinEstimado', 'tareas.tiempoEstimado', 'tareas.fechaInicioSolucion', 'tareas.fechaFinSolucion', 'tareas.tiempoSolucion',
                        'tareas.observaciones', 'tareas.estadoTarea_id', 'tareas.isError', 'tarea_tipos.nombre as tipo', 'tareas.proyecto_id')
                    ->leftjoin('tarea_tipos', 'tarea_tipos.id','=', 'tareas.tipoTarea_id')
                    ->where('user_id', '=', \Usuario::get('id'))
                    ->where('fechaInicioEstimado', '>=', $semanaActual->fechaInicio)
                    ->whereNull('tareas.deleted_at')
                    ->orderBy('tareas.fechaInicioEstimado', 'desc')
                    ->get();

        return $tareas;
    }


    public static function getTareasProgramadasUsuario($usuario_id, $fechaInicio, $fechaFin)
    {
        $tareas = Tarea::select('users.id as user_id','users.nombres','users.color', 'users.apellidos' ,'tareas.id', 'tareas.descripcion', 'tareas.fechaInicioEstimado', 'tareas.fechaFinEstimado', 'tareas.tiempoEstimado', 'tareas.fechaInicioSolucion', 'tareas.fechaFinSolucion', 'tareas.tiempoSolucion',
            'tareas.observaciones', 'tareas.estadoTarea_id', 'tareas.isError', 'tarea_tipos.nombre as tipo', 'tareas.proyecto_id')
            ->leftjoin('tarea_tipos', 'tarea_tipos.id','=', 'tareas.tipoTarea_id')
            ->join('users', 'users.id','=', 'tareas.user_id')
            ->where('user_id', '=', $usuario_id)
            ->where('fechaInicioEstimado', '>=', $fechaInicio)
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

    public static function getNumero()
    {
        $nro =  \DB::table('tareas')
            ->where('user_id', '=', \Usuario::get('id'))
            ->max('numero');
        if(!isset($nro)){
            return 1;
        }else{
            return $nro + 1;
        }

    }

    public static function getEstadosEditar()
    {
        return \DB::table('estado_tareas')
            ->whereNull('estado_tareas.deleted_at')
            ->where('estado_tareas.id', '<>', '3')
            ->get();
    }

    public static function Actualizar($tarea)
    {
        try
        {
            dd($tarea);
            \DB::table('tareas')
                ->where('id', $tarea->id)
                ->update([
                    'descripcion'=> "'".$tarea->descripcion."'",
                    'estadoTarea_id'=> "'".$tarea->estadoTarea_id."'",
                    'fechaInicioEstimado'=> "'".$tarea->fechaInicioEstimado."'",
                    'fechaFinEstimado'=> "'".$tarea->fechaFinEstimado."'",
                    'tiempoEstimado'=> "'".$tarea->tiempoEstimad."'"
            ]);
            return true;
        }catch (\Exception $errr){
            Log::info($errr);
            return false;
        }
    }

    public static function Resolver( $tarea)
    {

    }

    public function getTareasEliminados()
    {
        $tareas = Tarea::where('user_id', '=', \Usuario::get('id'))
                        ->whereNotNull('tareas.deleted_at')
                        ->get();

        return $tareas;
    }


    /**
     * Obtenemos datos de datos de la semana de la fecha buscada
     * Anio, mes, semana, fecha Inicio, fecha Fin
     *
     * @param $fecha
     * @return mixed
     */
    public static function getSemanasTareas($fecha)
    {
//        dd($fecha);
        $fechas =  \DB::select('call pa_obtenerFechaSemanaAnual(\''.$fecha.'\');');
//        dd($fechas);
        if(isset($fechas)){
            return $fechas[0];
        }else{
            Log::info('Error al obtener los datos de la fecha de las semana del año');

            \DB::select('call pa_obtenerFechaSemanaAnual(\''.date('Y-m-d').'\');');
        }
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

    public static function importarTareas($fechaInicio, $fechaFin)
    {
        // llamar aun procedimiento almacenado que retorne todas las tareas
        // agrupadas por tecnico y semana
        $fechas =  \DB::select('call pa_obtenerTareasEntreFechas(\''.$fechaInicio.'\', \''.$fechaFin.'\');');

        if(isset($fechas)){
            return $fechas;
        }else{
            Log::info('No hay tareas entre las fecha buscadas');
        }
    }

    public static function insetarTicketsEficacia($ticketsAbiertos, $ticketsCerrados, $anio, $mes, $semana, $fechaInicio, $fechaFin, $user_id)
    {
        try
        {
            if(isset($user_id))
            {
                Log::info($ticketsCerrados. '- '.$ticketsAbiertos);
                \DB::select("call pa_eficacia_insertarTicket(".$ticketsAbiertos.", ".$ticketsCerrados.", ".$anio.", ".$mes.", ".$semana.", '".$fechaInicio."', '".$fechaFin."', ".$user_id->p." );");

                return true;
            }else{
                return false;
            }

        }catch (\Exception $errr){
            Log::error('No importaron los usuarios en la tabla de eficacion');
            return false;
        }
    }


    public static function insertarTareasEficacia($programados, $resueltos, $anio, $mes, $semana, $fechaInicio, $fechaFin, $user_id)
    {
        try
        {
            \DB::select("call pa_eficacia_insertarTareas(".$programados.", ".$resueltos.", ".$anio.", ".$mes.", ".$semana.", '".$fechaInicio."', '".$fechaFin."', ".$user_id." );");

            return 'true';
        }catch (\Exception $errr){
            Log::error('No importaron los usuarios en la tabla de eficacion');
            return 'false';
        }
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
