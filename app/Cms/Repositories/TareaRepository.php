<?php
namespace ProyectoKpi\Cms\Repositories;

use function dd;
use Exception;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use ProyectoKpi\Cms\Clases\Caches;
use ProyectoKpi\Cms\Clases\Tiempo;
use ProyectoKpi\Cms\Semanas\SemanaTarea;
use ProyectoKpi\Cms\Semanas\validarFechaSemanaTarea;
use ProyectoKpi\Models\Tareas\Tarea;
use Illuminate\Http\Request;


trait TareaRepository
{
    use validarFechaSemanaTarea;


    /**
     * Retorna una tarea
     *
     * @param $tarea_id
     * @return mixed
     */
    public static function getTarea($tarea_id)
    {
         return \DB::table('vw_tareas_para_usuarios')
            ->where('user_id', '=', \Auth::user()->id)
            ->where('id', '=', $tarea_id)
            ->first();

    }

    public static function findTarea($tarea_id)
    {
        $tarea = \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Auth::user()->id)
            ->where('vw_tareas_para_usuarios.id', '=', $tarea_id )
            ->first();

        $lista = self::agregarUbicacionTareas($tarea);

        return $lista[0];
    }

    /**
     * Retorna las tareas programadas de la semana actual
     *
     * @param SemanaTarea $semanaTarea
     * @return mixed
     */
    public static function getTareaDeLaSemana(SemanaTarea $semanaTarea)
    {
        return \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Auth::user()->id)
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaInicio, \'%d/%m/%Y\')') ,'>=', DB::Raw('STR_TO_DATE(\''.$semanaTarea->getSemana()->fechaInicio.'\', \'%d/%m/%Y\')'))
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaFin, \'%d/%m/%Y\')') ,'<=', DB::Raw('STR_TO_DATE(\''.$semanaTarea->getSemana()->fechaFin.'\', \'%d/%m/%Y\')'))
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();

    }

    /**
     * Retorna las tareas programadas de la semana actual
     *
     * @param SemanaTarea $semanaTarea
     * @return mixed
     */
    public static function getTareaDeLaSemanaJson(SemanaTarea $semanaTarea)
    {
        $tareas =  \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Auth::user()->id)
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaInicio, \'%d/%m/%Y\')') ,'>=', DB::Raw('STR_TO_DATE(\''.$semanaTarea->getSemana()->fechaInicio.'\', \'%d/%m/%Y\')'))
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaFin, \'%d/%m/%Y\')') ,'<=', DB::Raw('STR_TO_DATE(\''.$semanaTarea->getSemana()->fechaFin.'\', \'%d/%m/%Y\')'))
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();

        return response()->json($tareas);

    }


    /**
     * Retorna las tareas programadas de la semana actual
     *
     * @param SemanaTarea $semanaTarea
     * @return mixed
     */
    public static function getTareaDeLaSemanaPorUser(SemanaTarea $semanaTarea, $user)
    {
        return \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', $user)
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaInicio, \'%d/%m/%Y\')') ,'>=', DB::Raw('STR_TO_DATE(\''.$semanaTarea->getSemana()->fechaInicio.'\', \'%d/%m/%Y\')'))
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaFin, \'%d/%m/%Y\')') ,'<=', DB::Raw('STR_TO_DATE(\''.$semanaTarea->getSemana()->fechaFin.'\', \'%d/%m/%Y\')'))
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();
    }

    /**
     * Retorna todas las tareas del usuario actual en session
     *
     * @return array
     */
    public static function getTodasTareaUsuario()
    {
        return \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Auth::user()->id)
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();

    }

    public static function getTareasArchivados(SemanaTarea $semanaTarea)
    {
        $tareas = \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Auth::user()->id)
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaInicio, \'%d/%m/%Y\')') ,'<', DB::Raw('STR_TO_DATE(\''.$semanaTarea->getSemana()->fechaInicio.'\', \'%d/%m/%Y\')'))
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();

        return ['success' => true, 'tareas' => $tareas];

    }

    public static function getTareasAgendadas(SemanaTarea $semanaTarea)
    {
        return \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Auth::user()->id)
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaInicio, \'%d/%m/%Y\')') ,'>=', DB::Raw('STR_TO_DATE(\''.$semanaTarea->getSemana()->fechaInicio.'\', \'%d/%m/%Y\')'))
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();
    }

    private static function agregarUbicacionTareas($tareas){
        $lista = array();

        if(! is_array($tareas)){
            $aux = $tareas;

            if($tareas->estado_id <> 1){
                $aux->ubicaciones = self::getLocalizacionTarea($tareas->id);

            }else{
                $aux->ubicaciones = [];
            }

            array_push($lista, $aux);
        }else{
            foreach ($tareas as $tarea){
                $aux = $tarea;

                if($tarea->estado_id <> 1){
                    $aux->ubicaciones = self::getLocalizacionTarea($tarea->id);

                }else{
                    $aux->ubicaciones = [];
                }

                array_push($lista, $aux);

            }
        }

        return $lista;
    }

    public static function validarTarea(Request $request)
    {
        $resultado = ['success' => true, 'message' => ''];
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;

//        return (self::validarFechaFormato($request->fechaFin));

        if(!self::validarFechaFormato($request->fechaInicio) || !self::validarFechaFormato($request->fechaFin))
        {
            return [
                'message' => trans('labels.messages.msgFormatoFecha'),
                'success' => false
            ];
        }

        if(!self::validarFechaLimiteTarea($fechaInicio) || !self::validarFechaLimiteTarea($fechaFin))
        {
            return [
                'message' => trans('labels.messages.msgFechaFueraRango'),
                'success' => false
            ];
        }


        if(!self::validarMayorIgual($fechaInicio, $fechaFin))
        {
            return [
                'message' =>trans('labels.messages.msgFechaMayor'),
                'success' => false
            ];
        }

        if(!self::validarDuracionCero((integer) $request->hora, (integer) $request->minuto))
        {
            return [
                'message' =>trans('labels.messages.msgDuracionCero'),
                'success' => false
            ];
        }

        return $resultado;
    }

    public static function guardar(Request $request)
    {
        $tarea = new Tarea;

        $tarea->numero = self::getMayorNumeroTarea();
        $tarea->descripcion = trim($request->descripcion);
        $tarea->fechaInicioEstimado = \Calcana::cambiarFormatoDB( $request->fechaInicio);
        $tarea->fechaFinEstimado = \Calcana::cambiarFormatoDB($request->fechaFin);

        // calculamos el tiempo de duracion de de la hora y minuto
        $horaReal = self::obtenerHora($request->hora, $request->minuto);
        $tarea->tiempoEstimado = $horaReal[0].':'.$horaReal[1];

        $tarea->tipoTarea_id = 1;
        $tarea->estadoTarea_id = 1;
        $tarea->user_id = \Auth::user()->id;

        if($tarea->save()){
            $semanas = new SemanaTarea();
            $tareas = self::getTareaDeLaSemana($semanas);
            return [
                'message' => 'La tarea Nro. '.$tarea->numero.' se guardo correctamente',
                'success' => true,
                'tareas'=> $tareas
            ];
        }else{
            return [
                'message' => 'No se guardo, por favor consulte con su administrador',
                'success' => false
            ];
        }
    }


    public function validarFechasTareas($fechaInicio, $fechaFin)
    {
        if ($this->validarFormatoFecha($fechaInicio) || $this->validarFormatoFecha($fechaFin))
        {
            return [
                'message' => 'Las fechas no tiene formato fecha dd/mm/yyyy',
                'success' => false
            ];
        }

        if(!self::validarFechaLimiteTarea($fechaInicio) || !self::validarFechaLimiteTarea($fechaFin)){
            return [
                'message' => 'Las fechas de la tarea estan fuera del rango permitido',
                'success' => false
            ];
        }

        if(\Calcana::verificarMayorIgual($fechaFin, $fechaInicio)== false){
            return [
                'message' => 'Las Fecha Inicio debe ser menor o igual a la Fecha Fin',
                'success' => false
            ];
        }
    }

    public static function resolver(Request $request, $id)
    {

        $tarea = Tarea::findOrFail($id);
        $tarea->descripcion = trim($request->descripcion);
        $tarea->fechaInicioSolucion = \Calcana::cambiarFormatoDB( $request->fechaInicio);
        $tarea->fechaFinSolucion = \Calcana::cambiarFormatoDB($request->fechaFin);

        // calculamos el tiempo de duracion de de la hora y minuto
        $horaReal = self::obtenerHora($request->hora, $request->minuto);
        $tarea->tiempoSolucion = $horaReal[0].':'.$horaReal[1];

        $tarea->tipoTarea_id = 1;
        $tarea->estadoTarea_id = 3;
        $tarea->observaciones = $request->observaciones;
        $tarea->user_id = \Usuario::get('id');

        if($tarea->save()){

            //  guardamos la localizacion de la tarea
            $localizaciones = $request->input('prov', []);
            DB::table('tarea_localizacion')->where('tarea_id', '=', $id)->delete();

            for ($i = 0; $i < count($localizaciones); $i++) {
                DB::table('tarea_localizacion')->insert(
                    ['tarea_id' => $id, 'localizacion_id' => $localizaciones[$i] ]
                );
            }


            return [
                'message' => 'La tarea se guardo correctamente',
                'success' => true
            ];
        }else{
            return [
                'message' => 'No se guardo, por favor consulte con su administrador',
                'success' => false
            ];
        }
    }

    public static function actualizar(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->descripcion = $request->descripcion;
        $tarea->fechaInicioEstimado = \Calcana::cambiarFormatoDB( $request->fechaInicio);
        $tarea->fechaFinEstimado = \Calcana::cambiarFormatoDB($request->fechaFin);

        // calculamos el tiempo de duracion de de la hora y minuto
        $horaReal = self::obtenerHora($request->hora, $request->minuto);
        $tarea->tiempoEstimado = $horaReal[0].':'.$horaReal[1];

        $tarea->estadoTarea_id = $request->estado;
        $tarea->observaciones = $request->observaciones;
        $tarea->user_id = \Auth::user()->id;

//        $tarea->save();
        if($tarea->save()){

            //  guardamos la localizacion de la tarea
            $localizaciones = $request->input('prov', []);
            DB::table('tarea_localizacion')->where('tarea_id', '=', $id)->delete();

            for ($i = 0; $i < count($localizaciones); $i++) {
                DB::table('tarea_localizacion')->insert(
                    ['tarea_id' => $id, 'localizacion_id' => $localizaciones[$i] ]
                );
            }


            return [
                'message' => 'La tarea se guardo correctamente',
                'success' => true
            ];
        }else{
            return [
                'message' => 'No se guardo, por favor consulte con su administrador',
                'success' => false
            ];
        }
    }

    public static function validarDuracionCero($hora, $minuto)
    {
        $resultado = true;
        if((integer) $hora == 0 && (integer) $minuto == 0){
            $resultado = false;
        }

        return $resultado;
    }

    private static function obtenerHora($horas, $minutos)
    {
        $tiempo = new Tiempo;

        return $tiempo->obtenerHora($horas, $minutos);
    }



    public static function obtenerSemanaDelAnioFecha($fecha)
    {

        $semanas =  \DB::select('call pa_obtenerFechaSemanaAnual(\''.$fecha.'\');');

        return $semanas[0];
    }

    public static function obtenerSemanaDelAnioFechaDB($fecha)
    {

        $semanas =  \DB::select('call pa_obtenerFechaSemanaAnualDB(\''.$fecha.'\');');

        return $semanas[0];
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

    public static function getTareasComunes()
    {
        return \DB::table('tarea_comunes')
            ->where('user_id', '=', \Auth::user()->id)
            ->select('tarea_comunes.id', 'tarea_comunes.titulo','tarea_comunes.color','tarea_comunes.textoColor')
            ->get();
    }

    public static function storeTareaComunes($titulo, $color)
    {
        \DB::table('tarea_comunes')->insert([
            ['titulo' => $titulo, 'color' => $color, 'user_id' => \Usuario::get('id')],
        ]);

        return self::getTareasComunes(\Usuario::get('id'));
    }

    public static function deleteTareaComunes($id)
    {

        \DB::table('tarea_comunes')->where('id', '=', $id)->delete();

        return self::getTareasComunes(\Usuario::get('id'));
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
            ->where('estado_tareas.visibleEmpleado', '=', 1)
            ->where('estado_tareas.visibleCalendario', '=', 1)
            ->select('estado_tareas.id', 'estado_tareas.nombre')
            ->get();
    }

//    public static function Actualizar($tarea)
//    {
//        try
//        {
//            \DB::table('tareas')
//                ->where('id', $tarea->id)
//                ->update([
//                    'descripcion'=> "'".$tarea->descripcion."'",
//                    'estadoTarea_id'=> "'".$tarea->estadoTarea_id."'",
//                    'fechaInicioEstimado'=> "'".$tarea->fechaInicioEstimado."'",
//                    'fechaFinEstimado'=> "'".$tarea->fechaFinEstimado."'",
//                    'tiempoEstimado'=> "'".$tarea->tiempoEstimado."'"
//                ]);
//            return true;
//        }catch (\Exception $errr){
//
//            return false;
//        }
//    }


    public static function getEstados()
    {
        return \DB::table('estado_tareas')
            ->whereNull('estado_tareas.deleted_at')
            ->where('estado_tareas.visibleCalendario', '=', 1)
            ->where('estado_tareas.visibleEmpleado', '=', 1)
            ->select('estado_tareas.id', 'estado_tareas.nombre', 'estado_tareas.color', 'estado_tareas.texto')
            ->get();
    }


    /**
     * tareas programadas para el  calendario
     *
     */
    public static function getTareasCalendar(SemanaTarea $semanaTarea)
    {
        $tareas =  Tarea::getTodasTareaUsuario();

        //  cargamos los datos de las semanas para marcar la semana actual en el calendario
        $semana = new \stdClass();
        $semana->start = \Calcana::cambiarFormatoDB($semanaTarea->getSemana()->fechaInicio);
        $semana->end = \Calcana::sumarDias(\Calcana::cambiarFormatoDB($semanaTarea->getSemana()->fechaFin), 1);
        $semana->overlap = false;
        $semana->rendering = 'background';
        $semana->color = '#ff9f89';


        $data = array();
        array_push($data, $semana);

        foreach ($tareas  as $tarea){
            $valor = new \stdClass();

            $valor->id = $tarea->id;
            $valor->title = $tarea->numero.'. ' .$tarea->descripcion;
            $valor->descrip = $tarea->descripcion;
            $valor->start =  \Calcana::cambiarFormatoDB($tarea->fechaInicio);
            $valor->end =  \Calcana::cambiarFormatoDB($tarea->fechaFin).'T23:59:59';
            $valor->hora = $tarea->tiempo;
            $valor->backgroundColor = $tarea->colorEstado;
            $valor->borderColor = $tarea->colorEstado;
            $valor->textColor = $tarea->textoColor;
            $valor->nro = $tarea->numero;
            $semana->overlap = false;
//            $valor->allDay = false;
            $valor->estado = $tarea->estado;
            $valor->numero = $tarea->numero;
            $valor->observaciones = $tarea->observaciones;
            $valor->can_delete = $tarea->can_delete;
            $valor->can_change = $tarea->can_change;

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

    // lista de ubidadciones Ocupadas para una tarea
    public static function ubicacionTarea($tarea_id)
    {
        return
            DB::table('localizaciones')
                ->join('tarea_localizacion','tarea_localizacion.localizacion_id','=', 'localizaciones.id')
                ->where('tarea_localizacion.tarea_id',$tarea_id)
                ->select('localizaciones.id','localizaciones.nombre')->get();

        /*
        if(!is_null(\Usuario::get('localizacion')) && !empty(\Usuario::get('localizacion')))
        {
            $localizacion = DB::table('localizaciones')->where('localizaciones.id', \Usuario::get('localizacion')->id)->first();
        // $localizaciones = DB::table('localizaciones')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->select('localizaciones.id','localizaciones.nombre')->get();

        $ubicacionesOcupadas = DB::table('localizaciones')->join('tarea_localizacion','tarea_localizacion.localizacion_id','=', 'localizaciones.id')
            ->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)
            ->where('tarea_localizacion.tarea_id',$tarea_id)
            ->select('localizaciones.id','localizaciones.nombre')->get();


        return $ubicacionesOcupadas;
        }else{
            return [];
        }
*/
    }


    // lista de ubidadciones disponbiles para una tarea
    public static function ubicacionesDisponibles($tarea_id)
    {
        if(!is_null(\Usuario::get('localizacion')) && !empty(\Usuario::get('localizacion')))
        {
            $localizacion = DB::table('localizaciones')->where('localizaciones.id','=', \Usuario::get('localizacion')->id)->first();

            $ubicacionesDisponible  = DB::select('call pa_tareas_ubicaionesDisponibles('.$localizacion->grupoloc_id.','.$tarea_id.');');

            return $ubicacionesDisponible;
        }else{
            return [];
        }
    }

    // lista de ubidadciones disponbiles para una tarea
    public static function ubicacionesTodos($tarea_id)
    {
        if(!is_null(\Usuario::get('localizacion')) && !empty(\Usuario::get('localizacion'))) {
            $localizacion = DB::table('localizaciones')->where('localizaciones.id', '=', \Usuario::get('localizacion')->id)->first();
            $localizaciones = DB::table('localizaciones')->select('localizaciones.id', 'localizaciones.nombre')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->get();

            return $localizaciones;
        }else{
            return [];
        }
    }

    /**
     * Retorn la lista de la ubicaciones donde se realizo una tarea
     *
     * @param $tarea_id
     * @return mixed
     */
    public static function getLocalizacionTarea($tarea_id)
    {
        $localizacion = \DB::select('call pa_ubicaciones_tareas('.$tarea_id.')');

        return $localizacion;
    }

    public static function getTareasArchivadosJson(SemanaTarea $semanaTarea)
    {
         $tareas = \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Auth::user()->id)
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaInicio, \'%d/%m/%Y\')') ,'<', DB::Raw('STR_TO_DATE(\''.$semanaTarea->getSemana()->fechaInicio.'\', \'%d/%m/%Y\')'))
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();

        return response()->json($tareas);

    }

    public static function getTareasAgendadasJson(SemanaTarea $semanaTarea)
    {
        $tareas =  \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Auth::user()->id)
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaInicio, \'%d/%m/%Y\')') ,'>=', DB::Raw('STR_TO_DATE(\''.$semanaTarea->getSemana()->fechaInicio.'\', \'%d/%m/%Y\')'))
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();

        return response()->json($tareas);
    }

    public static function filtrarTareas(Request $request)
    {
        if($request->fechaInicio != '') {
            if (!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $request->fechaInicio)
            ) {
                return [
                    'message' => 'Las fechas no tiene formato fecha dd/mm/yyyy',
                    'success' => false,
                    'tareas' => []
                ];
            }
        }

        if($request->fechaFin != '') {
            if (!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $request->fechaFin)
            ) {
                return [
                    'message' => 'Las fechas no tiene formato fecha dd/mm/yyyy',
                    'success' => false,
                    'tareas' => []
                ];
            }
        }

        // armamos la consulta en formato sql con el request
        $query = self::queryValidaBuscar($request);
        $user_id = (String) \Auth::user()->id;
        $arQuery =  "(vw_tareas_para_usuarios.user_id = ".$user_id.") ". $query;

        try{
            $tareas = DB::table('vw_tareas_para_usuarios')
                ->select(DB::raw(' distinct(id), numero, descripcion, fechaInicio, fechaFin, tiempo, observaciones, estado_id, estado, colorEstado, textoColor,tipo_id, tipo,user_id, updated_at'))
                ->whereRaw($arQuery)
                ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
                ->get();

            return ['tareas'=> $tareas, 'success'=> true];
        }catch (ErrorException $err){
            return ['success'=> false, 'tareas' => []];
        }
    }

    protected static function queryValidaBuscar($request)
    {
        $query = "";

        if($request->tarea_nro != "") {
            if($query != ""){
                $query = $query ." AND ";
            }

            $query = $query . ' vw_tareas_para_usuarios.numero = ' . (integer) $request->tarea_nro ;
        }
        if($request->fechaInicio != "") {
            if($query != ""){
                $query = $query ." AND ";
            }
            $query = $query . ' STR_TO_DATE(vw_tareas_para_usuarios.fechaInicio, \'%d/%m/%Y\') >= STR_TO_DATE(\''.$request->fechaInicio.'\', \'%d/%m/%Y\')';
        }

        if($request->fechaFin != "") {
            if($query != ""){
                $query = $query ." AND ";
            }
            $query = $query . ' STR_TO_DATE(vw_tareas_para_usuarios.fechaFin, \'%d/%m/%Y\') <= STR_TO_DATE(\''.$request->fechaFin.'\', \'%d/%m/%Y\')';
        }

        if($request->estado_id != "") {
            if($query != ""){
                $query = $query ." AND ";
            }

            $query = $query . ' vw_tareas_para_usuarios.estado_id = ' . (String)  $request->estado_id ;
        }

        if($query != ""){
            $query = " AND ".$query;
        }

        return (String) $query;

    }


    public static function validarVacio(Request $request)
    {
        try {
            if ($request->tarea_nro == "" &&
                $request->fechaInicio == "" &&
                $request->fechaFin == "" &&
                $request->estado_id == ""
            ) {

                return ['success' => true];
            }else {
                return ['success' => false];
            }
        }catch (Exception $ex){
            return ['success' => false];
        }



    }

}
