<?php
namespace ProyectoKpi\Cms\Repositories;

use function dd;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;
use ProyectoKpi\Cms\Clases\Caches;
use ProyectoKpi\Cms\Clases\Tiempo;
use ProyectoKpi\Http\Requests\Request;
use ProyectoKpi\Models\Tareas\Tarea;

trait TareaRepository
{

    /* Metodos */

    /**
     * Retorna la lista de tarea mas semana  utilizada para encontrar las tareas
    */
    public static function getTodasTareaSemana($agenda)
    {
        // Obtenemos las semanas de tareas
        $semanaActual = self::obtenerSemanaDelAnio($agenda);

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

    public static function getTareaDataTable($agenda)
    {
        // Obtenemos las semanas de tareas
        $semanaActual = self::obtenerSemanaDelAnio($agenda);

        return \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Usuario::get('id'))
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaInicio, \'%d/%m/%Y\')') ,'>=', DB::Raw('STR_TO_DATE(\''.$semanaActual->fechaInicio.'\', \'%d/%m/%Y\')'))
            ->where(DB::raw('STR_TO_DATE(vw_tareas_para_usuarios.fechaFin, \'%d/%m/%Y\')') ,'<=', DB::Raw('STR_TO_DATE(\''.$semanaActual->fechaFin.'\', \'%d/%m/%Y\')'))
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();
    }

    /**
     * Retorna la lista de tarea del usuario utilizada para encontrar las tareas
     */
    public static function getTodasTareaUsuario()
    {
        // Obtenemos las semanas de tareas

        $tareas = \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Usuario::get('id'))
            ->orderBy('vw_tareas_para_usuarios.numero', 'desc')
            ->get();

        $lista = self::agregarUbicacionTareas($tareas);
        // agregamos la semana actual

        return $lista;
    }

    public static function findTarea($id)
    {
        // Obtenemos las semanas de tareas
        $semanaActual = self::obtenerSemanaDelAnio(0);

        $tarea = \DB::table('vw_tareas_para_usuarios')
            ->where('vw_tareas_para_usuarios.user_id', '=', \Usuario::get('id'))
            ->where('vw_tareas_para_usuarios.id', '=',$id )
            ->first();

        $lista = self::agregarUbicacionTareas($tarea);
        // agregamos la semana actual
        array_push($lista, $semanaActual);

        return $lista;
    }

    public static function getTareasArchivados()
    {
        // Obtenemos las semanas de tareas
        $semanaActual = self::obtenerSemanaDelAnio(0);

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
        $semanas = self::obtenerSemanaDelAnio(0);

        // Semana siguiente a la actual
        $semanaSiguiente = self::obtenerSemanaDelAnio(1);

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

    public static function getLocalizacionTarea($tarea_id)
    {
        $localizacion = \DB::select('call pa_ubicaciones_tareas('.$tarea_id.')');

        return $localizacion;
    }

    public static function getTarea($tarea_id)
    {

        $tarea = \DB::table('vw_tareas_para_usuarios')
            ->where('user_id', '=', \Usuario::get('id'))
            ->where('id', '=', $tarea_id)
            ->first();

        return $tarea;
    }

    function validar_fecha($fecha){
        if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $fecha)) {
            return true;
        } else {
            return false;
        }
    }
    public static function guardar(Request $request)
    {
        if (!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $request->fechaInicio) || !preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $request->fechaFin)) {
            return [
                'message' => 'Las fechas no tiene formato fecha dd/mm/yyyy',
                'success' => false
            ];
        }

        if(!self::validarFechaLimiteTarea($request->fechaInicio, $request->agenda) || !self::validarFechaLimiteTarea($request->fechaFin, $request->agenda)){
            return [
                'message' => 'Las fechas de la tarea estan fuera del rango permitido',
                'success' => false
            ];
        }


        if(\Calcana::verificarMayorIgual($request->fechaFin, $request->fechaInicio)== false){
            return [
                'message' => 'Las Fecha Inicio debe ser menor o igual a la Fecha Fin',
                'success' => false
            ];
        }

        $semanas = self::obtenerSemanaDelAnio($request->agenda);

        if(!self::validarDuracionCero($request->hora, $request->minuto)){
            return [
                'message' => 'La duracion de una tarea no puede ser cero "0"',
                'success' => false
            ];
        }

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
        $tarea->user_id = \Usuario::get('id');

        if($tarea->save()){
            $tareas = self::getTodasTareaSemana($request->agenda);
            $semanas = array_pop($tareas);
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

    public static function resolver(Request $request, $id)
    {
        if (!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $request->fechaInicioSolucion) || !preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $request->fechaFinSolucion)) {
            return [
                'message' => 'Las fechas no tiene formato fecha dd/mm/yyyy',
                'success' => false
            ];
        }

        if(!self::validarFechaLimiteTarea($request->fechaInicioSolucion, $request->agenda) || !self::validarFechaLimiteTarea($request->fechaFinSolucion, $request->agenda)){
            return [
                'message' => 'Las fechas de la tarea estan fuera del rango permitido',
                'success' => false
            ];
        }


        if(\Calcana::verificarMayorIgual($request->fechaFinSolucion, $request->fechaInicioSolucion)== false){
            return [
                'message' => 'Las Fecha Inicio debe ser menor o igual a la Fecha Fin',
                'success' => false
            ];
        }

        $semanas = self::obtenerSemanaDelAnio($request->agenda);

        if(!self::validarDuracionCero($request->hora, $request->minuto)){
            return [
                'message' => 'La duracion de una tarea no puede ser cero "0"',
                'success' => false
            ];
        }

        $tarea = Tarea::findOrFail($id);
        $tarea->fechaInicioSolucion = \Calcana::cambiarFormatoDB( $request->fechaInicioSolucion);
        $tarea->fechaFinSolucion = \Calcana::cambiarFormatoDB($request->fechaFinSolucion);

        // calculamos el tiempo de duracion de de la hora y minuto
        $horaReal = self::obtenerHora($request->hora, $request->minuto);
        $tarea->tiempoSolucion = $horaReal[0].':'.$horaReal[1];

        $tarea->tipoTarea_id = 1;
        $tarea->estadoTarea_id = 3;
        $tarea->observaciones = $request->observaciones;
        $tarea->user_id = \Usuario::get('id');
//dd($tarea, $request);
        $tarea->save();
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
        if (!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $request->fechaInicioEstimado) || !preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $request->fechaFinEstimado)) {
            return [
                'message' => 'Las fechas no tiene formato fecha dd/mm/yyyy',
                'success' => false
            ];
        }

        if(!self::validarFechaLimiteTarea($request->fechaInicioEstimado, $request->agenda) || !self::validarFechaLimiteTarea($request->fechaFinEstimado, $request->agenda)){
            return [
                'message' => 'Las fechas de la tarea estan fuera del rango permitido',
                'success' => false
            ];
        }


        if(\Calcana::verificarMayorIgual($request->fechaFinEstimado, $request->fechaInicioEstimado)== false){
            return [
                'message' => 'Las Fecha Inicio debe ser menor o igual a la Fecha Fin',
                'success' => false
            ];
        }

        $semanas = self::obtenerSemanaDelAnio($request->agenda);

        if(!self::validarDuracionCero($request->hora, $request->minuto)){
            return [
                'message' => 'La duracion de una tarea no puede ser cero "0"',
                'success' => false
            ];
        }

        $tarea = Tarea::findOrFail($id);
        $tarea->fechaInicioEstimado = \Calcana::cambiarFormatoDB( $request->fechaInicioEstimado);
        $tarea->fechaFinEstimado = \Calcana::cambiarFormatoDB($request->fechaFinEstimado);

        // calculamos el tiempo de duracion de de la hora y minuto
        $horaReal = self::obtenerHora($request->hora, $request->minuto);
        $tarea->tiempoEstimado = '\''.$horaReal[0].':'.$horaReal[1].'\'';

        $tarea->estadoTarea_id = $request->estado;
        $tarea->observaciones = '\''. $request->observaciones.'\'';
        $tarea->user_id = \Usuario::get('id');
//dd($tarea, $request);
        $tarea->save();
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

    /* Validaciones de Tareas */
    public static function validarFechaLimiteTarea($fecha, $agenda)
    {
        // validar que la fecha de inicio se menor o igual a la fecha fin
        $semanas = self::obtenerSemanaDelAnio($agenda);

        $resultado = false;

        if((integer) $agenda === 0){
            if( \Calcana::verificarMayorIgual($fecha, $semanas->fechaInicio) && \Calcana::verificarMenorIgual($fecha, $semanas->fechaFin))
            {
                $resultado = true;
            }
        }else{
            $semanasAgenda = Caches::obtener('semana_buscada');

            if( \Calcana::verificarMayorIgual($fecha, $semanasAgenda->fechaInicio) && \Calcana::verificarMenorIgual($fecha, $semanasAgenda->fechaFin))
            {
                $resultado = true;
            }
        }

        return $resultado;
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

    /**
     * Devuelve las datos de semana 'anio, mes, seman, fecha inicio y fin' de tarea
     *
     * @return mixed
     */
    public static function obtenerSemanaDelAnio($agenda)
    {
        $fecha = date('Y-m-d');

        if ((integer) $agenda === 1) {
            $fecha = date(date('Y-m-d', strtotime('now +7 day')));
        }
        $semanas =  \DB::select('call pa_obtenerFechaSemanaAnual(\''.$fecha.'\');');

        return $semanas[0];
    }

    /**
     * Devuelve las datos de semana 'anio, mes, seman, fecha inicio y fin' de tarea
     *
     * @return mixed
     */
    public static function obtenerSemanaDelAnioFecha($fecha)
    {
        $semanas =  \DB::select('call pa_obtenerFechaSemanaAnual(\''.\Calcana::cambiarFormatoDB($fecha).'\');');
        Caches::guardar('semana_buscada', $semanas[0]);

        return $semanas[0];
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
            ->where('fechaInicioEstimado', '>=', \Calcana::cambiarFormatoDB( $fechaInicio))
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

    public static function getTareasComunes($user_id)
    {
        $tarea_comun = \DB::table('tarea_comunes')
            ->where('user_id', '=', $user_id)
            ->select('tarea_comunes.id', 'tarea_comunes.titulo','tarea_comunes.color','tarea_comunes.textoColor')
            ->get();

        return $tarea_comun;
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
            ->select('estado_tareas.id', 'estado_tareas.nombre', 'estado_tareas.color', 'estado_tareas.texto')
            ->get()
            ->take(10);
    }


    /**
     * tareas programadas para el  calendario
     *
     */
    public static function getTareasCalendar($user_id)
    {
        $tareas =  Tarea::getTodasTareaUsuario();

        $semanas = self::obtenerSemanaDelAnio(0);

        //  cargamos los datos de las semanas para marcar la semana actual en el calendario
        $semana = new \stdClass();
        $semana->start = \Calcana::cambiarFormatoDB($semanas->fechaInicio);
        $semana->end = \Calcana::sumarDias(\Calcana::cambiarFormatoDB($semanas->fechaFin), 1);
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

}
