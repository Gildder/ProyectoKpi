<?php
namespace ProyectoKpi\Cms\Repositories;

use function dd;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;
use ProyectoKpi\Http\Requests\Request;
use ProyectoKpi\Models\Tareas\Tarea;

trait TareaRepository
{

    /* Metodos */
    public static function getTodasTareas()
    {
        // Obtenemos las semanas de tareas
        $semanaActual = TareaRepository::getSemanasTareas(date('Y-m-d'));

        $tareas = \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Usuario::get('id'))
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaInicio, \'%d/%m/%Y\')') ,'>=', DB::Raw('STR_TO_DATE(\''.$semanaActual->fechaInicio.'\', \'%d/%m/%Y\')'))
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaFin, \'%d/%m/%Y\')') ,'<=', DB::Raw('STR_TO_DATE(\''.$semanaActual->fechaFin.'\', \'%d/%m/%Y\')'))
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();

        $lista = self::agregarUbicacionTareas($tareas);
        // agregamos la semana actual
        array_push($lista, $semanaActual);

        return $lista;
    }

    public static function getTareasArchivados()
    {
        // Obtenemos las semanas de tareas
        $semanaActual = TareaRepository::getSemanasTareas(date('Y-m-d'));

        $tareas = \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Usuario::get('id'))
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaInicio, \'%d/%m/%Y\')') ,'<', DB::Raw('STR_TO_DATE(\''.$semanaActual->fechaInicio.'\', \'%d/%m/%Y\')'))
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();

        $lista = self::agregarUbicacionTareas($tareas);
        // agregamos la semana actual
        array_push($lista, $semanaActual);

        return $lista;

    }

    public static function getTareasAgendadas()
    {
        // Obtenemos las semanas de tareas
        $semanas = TareaRepository::getSemanasTareas(date('Y-m-d'));

        // Semana siguiente a la actual
        $semanaSiguiente = TareaRepository::getSemanasTareas(date(date('Y-m-d', strtotime('now +7 day'))));

        $tareas = \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Usuario::get('id'))
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaInicio, \'%d/%m/%Y\')') ,'>', DB::Raw('STR_TO_DATE(\''.$semanas->fechaFin.'\', \'%d/%m/%Y\')'))
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();

        $lista = self::agregarUbicacionTareas($tareas);
        // agregamos la semana actual
        array_push($lista, $semanaSiguiente);

        return $lista;
    }

    private static function agregarUbicacionTareas($tareas){
        $lista = array();

        foreach ($tareas as $tarea){
            $aux = $tarea;

            $aux->ubicaciones = self::getLocalizacionTarea($tarea->id);
            array_push($lista, $aux);
        }

        return $lista;
    }

    public static function getLocalizacionTarea($tarea_id)
    {
        $localizacion = \DB::select('call pa_ubicaciones_tareas('.$tarea_id.')');

        return $localizacion;
    }

    public static function getTarea($tarea_id)
    {

        $tarea = \DB::table('vw_tareas_para_usuarios')
            ->where('user_id', '=', \Usuario::get('id'))
            ->where('id', '>=', $tarea_id)
            ->first();

        return $tarea;
    }

    public static function guardar(Request $request)
    {
        if(!self::validarFechasTarea($request->fechaInicioEstimado) && !self::validarFechasTarea($request->fechaFinEstimado)){
            return ['error' => 'Las fechas de la tarea estan fuera del rango permitido'];
        }

        if(!self::validarDuracion($request->fechaInicioEstimado) && !self::validarDuracion($request->fechaFinEstimado)){
            return ['error' => 'La duracion de una tarea no puede ser cero "0"'];
        }

        $tarea = new Tarea;
        $tarea->numero = self::getMayorNumeroTarea();
        $tarea->descripcion = trim($request->descripcion);
        $tarea->fechaInicioEstimado = $tarea->validarFechaInicioEstimacion(\Request::input('fechaInicioEstimado'), \Request::input('todasemana'));
        $tarea->fechaFinEstimado = $tarea->validarFechaFinEstimacion(\Request::input('fechaFinEstimado'), \Request::input('todasemana'));
        $horaReal = $tarea->obtenerHora(trim(\Request::input('hora')), trim(\Request::input('minuto')));
        $tarea->tiempoEstimado = $horaReal[0].':'.$horaReal[1];
        $tarea->tipoTarea_id = '1';
        $tarea->estadoTarea_id = '1';
        $tarea->user_id = \Usuario::get('id');


    }


    /* Validaciones de Tareas */
    public static function validarFechasTarea($fecha)
    {

    }


    public static function getTareasProgramadasUsuario($usuario_id, $fechaInicio, $fechaFin)
    {
        $tareas = Tarea::select('users.id as user_id','users.name as usuario','tareas.id as tarea_id','tareas.numero as nro','users.nombres','users.color','users.codigo', 'users.apellidos', 'users.email' ,'tareas.id', 'tareas.descripcion', 'tareas.fechaInicioEstimado', 'tareas.fechaFinEstimado', 'tareas.tiempoEstimado', 'tareas.fechaInicioSolucion', 'tareas.fechaFinSolucion', 'tareas.tiempoSolucion',
            'departamentos.nombre as departamento', 'localizaciones.nombre as localizacion', 'cargos.nombre as cargo',
            'tareas.observaciones', 'tareas.estadoTarea_id', 'tareas.isError', 'tarea_tipos.nombre as tipo', 'tareas.proyecto_id')
            ->leftjoin('tarea_tipos', 'tarea_tipos.id','=', 'tareas.tipoTarea_id')
            ->join('users', 'users.id','=', 'tareas.user_id')
            ->join('departamentos', 'departamentos.id','=', 'users.departamento_id')
            ->join('localizaciones', 'localizaciones.id','=', 'users.localizacion_id')
            ->join('cargos', 'cargos.id','=', 'users.cargo_id')
            ->where('user_id', '=', $usuario_id)
            ->where('fechaInicioEstimado', '>=', $fechaInicio)
            ->whereNull('tareas.deleted_at')
            ->orderBy('tareas.fechaInicioEstimado', 'desc')
            ->get();

        return $tareas;
    }


    public static function getBuscarTareasProgramadasSupervisor(Request $tareas)
    {
        // $tarea_nro, $user_id, $localizacion_id, $tipo_fechas, $fechaInicio, $fechaFin, $estado, $user_evaluador_id;
        $fechaInicioDescrip = obtenerDescripFechas(0, $tareas->tipo_fechas);
        $fechaFinDescrip = obtenerDescripFechas(1, $tareas->tipo_fechas);

        $tareas = Tarea::select('users.id as user_id','users.name as usuario','tareas.id as tarea_id','tareas.numero as nro','users.nombres','users.color','users.codigo', 'users.apellidos', 'users.email' , 'tareas.descripcion', 'tareas.fechaInicioEstimado', 'tareas.fechaFinEstimado', 'tareas.tiempoEstimado', 'tareas.fechaInicioSolucion', 'tareas.fechaFinSolucion', 'tareas.tiempoSolucion',
            'departamentos.nombre as departamento', 'localizaciones.nombre as localizacion', 'cargos.nombre as cargo',
            'tareas.observaciones', 'tareas.estadoTarea_id', 'tareas.isError', 'tarea_tipos.nombre as tipo', 'tareas.proyecto_id')
            ->leftjoin('tarea_tipos', 'tarea_tipos.id','=', 'tareas.tipoTarea_id')
            ->join('users', 'users.id','=', 'tareas.user_id')
            ->join('departamentos', 'departamentos.id','=', 'users.departamento_id')
            ->join('localizaciones', 'localizaciones.id','=', 'users.localizacion_id')
            ->join('cargos', 'cargos.id','=', 'users.cargo_id')
            ->join('tarea_localizacion', 'tarea_localizacion.tarea_id','=', 'tareas.id')
            ->orWhere('tareas.numero', '=', $tareas->tarea_nro)
            ->orWhere('tareas.user_id', '=', $tareas->user_id)
            ->orWhere('tarea_localizacion.localizacion_id', '=', $tareas->localizacion_id)
            ->orWhere($fechaInicioDescrip, '>=', $tareas->fechaInicio)
            ->orWhere($fechaFinDescrip, '<=', $tareas->fechaFin)
            ->orWhere('tareas.estadoTarea_id', '=', $tareas->estado)
            ->whereNull('tareas.deleted_at')
            ->orderBy('tareas.fechaInicioEstimado', 'desc')
            ->get();

        return $tareas;
    }



    public static function buscarTareasDeSupervisores(Request $request)
    {

    }



    /**
     * @param $opcion: 0: fecha de inicio, 1: fecha de fin
     * @param $tipo: 0: fecha de estimadas, 1: fechas solucion
     */
    private function obtenerDescripFechas($opcion, $tipo)
    {
        $inicioOrFin ='';
        $fechaDescrip = '';

        if ($opcion == 0) // Inicio
        {
            $inicioOrFin = 'Inicio';
        }else{            // Fin
            $inicioOrFin = 'Fin';
        }

        if ($tipo == 0) // fechas estimadas
        {
            $fechaDescrip = 'fecha'+$inicioOrFin+'Estimado';
        }else{          // fecha solucion
            $fechaDescrip = 'fecha'+$inicioOrFin+'Solucion';
        }

        return $fechaDescrip;
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

    public static function getMayorNumeroTarea()
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
            ->select('estado_tareas.id', 'estado_tareas.nombre')
            ->get();
    }

    public static function Actualizar($tarea)
    {
        try
        {
            \DB::table('tareas')
                ->where('id', $tarea->id)
                ->update([
                    'descripcion'=> "'".$tarea->descripcion."'",
                    'estadoTarea_id'=> "'".$tarea->estadoTarea_id."'",
                    'fechaInicioEstimado'=> "'".$tarea->fechaInicioEstimado."'",
                    'fechaFinEstimado'=> "'".$tarea->fechaFinEstimado."'",
                    'tiempoEstimado'=> "'".$tarea->tiempoEstimado."'"
                ]);
            return true;
        }catch (\Exception $errr){

            return false;
        }
    }

    public static function Resolver( $tarea)
    {

    }

    public static function getEstados()
    {
        return \DB::table('estado_tareas')
            ->whereNull('estado_tareas.deleted_at')
            ->select('estado_tareas.id', 'estado_tareas.nombre', 'estado_tareas.color', 'estado_tareas.texto')
            ->get();
    }


    /**
     * tareas programadas para el  calendario
     *
     */
    public static function getTareasCalendar($user_id)
    {
        $tareas =  Tarea::where('user_id', $user_id)
            ->join('estado_tareas', 'estado_tareas.id', '=', 'tareas.estadoTarea_id')
            ->select(
                'tareas.id',
                'tareas.numero',
                'tareas.descripcion',
                'tareas.fechaInicioEstimado',
                'tareas.fechaFinEstimado',
                'tareas.tiempoEstimado',
                'tareas.fechaInicioSolucion',
                'tareas.fechaFinSolucion',
                'tareas.tiempoSolucion',
                'tareas.estadoTarea_id as estado_id',
                'estado_tareas.nombre as estado',
                'estado_tareas.color',
                'estado_tareas.texto'
            )
            ->get();

        $data = array();

        foreach ($tareas  as $tarea){
            $valor = new \stdClass();

            $valor->title = $tarea->numero.'. ' .$tarea->descripcion;
            $valor->descrip = $tarea->descripcion;
            if($tarea->fechaInicioSolucion != '0000-00-00' || $tarea->fechaFinSolucion != '0000-00-00'){
                $valor->start = $tarea->fechaInicioSolucion;
                $valor->fin = $tarea->fechaFinSolucion;
                $valor->hora = $tarea->tiempoSolucion;
            }else{
                $valor->start = $tarea->fechaInicioEstimado;
                $valor->fin = $tarea->fechaFinEstimado;
                $valor->hora = $tarea->tiempoEstimado;
            }
            $valor->backgroundColor = $tarea->color;
            $valor->borderColor = $tarea->color;
            $valor->textColor = $tarea->texto;
            $valor->id = $tarea->id;
            $valor->nro = $tarea->numero;
            $valor->allDay = true;
            $valor->estado = $tarea->estado;
            $valor->numero = $tarea->numero;

            array_push($data, $valor);
        }
        return json_encode($data);
    }

    public static function EmpleadosDeIndicador($indicador_id)
    {
        $usuarios = \DB::select('call pa_empleado_con_IndicadorId(1)');

        return $usuarios;
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
//        dd(\GuzzleHttp\json_encode($fecha));
        $fechas =  \DB::select('call pa_obtenerFechaSemanaAnual('.json_encode($fecha).');');

        if(isset($fechas[0])){
            return $fechas[0];
        }else{
            Log::info('Error al obtener los datos de la fecha de las semana del año');

            \DB::select('call pa_obtenerFechaSemanaAnual(\''.date('Y-m-d').'\');');
        }
    }

    public static  function importarTickets($fechaInicio, $fechaFin)
    {
        try {

            // se toman en cuentas los ticket abiertos en domingo
            if(date("N", strtotime($fechaInicio))== 1){
                $fechaInicio = \Calcana::restarDias($fechaInicio, 1);
                $fechaFin = \Calcana::restarDias($fechaFin, 1);
            }

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

    public static function insertarTicketsEficacia($ticketsAbiertos, $ticketsCerrados, $anio, $mes, $semana, $fechaInicio, $fechaFin, $user_id, $isVacacion)
    {
        try
        {
            if(isset($user_id))
            {
                \DB::select("call pa_eficacia_insertarTicket(".$ticketsAbiertos.", ".$ticketsCerrados.", ".$anio.", ".$mes.", ".$semana.", '".$fechaInicio."', '".$fechaFin."', ".$user_id.", ".$isVacacion." );");

                return true;
            }else{
                return false;
            }

        }catch (\Exception $errr){
            Log::error('No importaron los usuarios en la tabla de eficacion');
            return false;
        }
    }


    public static function insertarTareasEficacia($programados, $resueltos, $anio, $mes, $semana, $fechaInicio, $fechaFin, $user_id, $isVacacion)
    {
//        dd($programados, $resueltos, $anio, $mes, $semana, $fechaInicio, $fechaFin, $user_id);
        try
        {
            \DB::select("call pa_eficacia_insertarTareas(".$programados.", ".$resueltos.", ".$anio.", ".$mes.", ".$semana.", '".$fechaInicio."', '".$fechaFin."', ".$user_id.", ".$isVacacion." );");

            return true;
        }catch (\Exception $errr){
            Log::error('No importaron los usuarios en la tabla de eficacion');
            return false;
        }
    }

    public static function insertarTareasEficiencia($realizado, $error, $anio, $mes, $semana, $fechaInicio, $fechaFin, $user_id)
    {
        try
        {
            \DB::select("call pa_eficiencia_insertarTareas(".$realizado.", ".$error.", ".$anio.", ".$mes.", ".$semana.", '".$fechaInicio."', '".$fechaFin."', ".$user_id." );");

            return true;
        }catch (\Exception $err){
            Log::error('No importaron los usuarios en la tabla de eficacion');
            return $err->getMessage();
//            return false;
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
        }catch (\Exception $err){
            return false;
        }
    }

    /**
     * Las localizaciones de disponibles para un empleado particular
     *
     */
    public static function getLocalizaciones()
    {
        $localizacion = DB::table('localizaciones')->where('localizaciones.id', \Usuario::get('localizacion'))->first();


        $localizaciones = DB::table('localizaciones')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->select('localizaciones.id','localizaciones.nombre')->get();

        return $localizaciones;
    }

}
