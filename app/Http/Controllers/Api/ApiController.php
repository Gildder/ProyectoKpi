<?php

namespace ProyectoKpi\Http\Controllers\Api;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

use ProyectoKpi\Cms\Semanas\SemanaTarea;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Models\Api\TareaEstadoTiempo;
use ProyectoKpi\Models\Api\TareaHistoricoProceso;
use ProyectoKpi\Models\Tareas\Estados;
use ProyectoKpi\Models\Tareas\Tarea;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{

    function __construct()
    {
        $this->middleware('cors', ['only' => ['getTareas']]);
    }


    /**
     * Devuelve todas las tareas de la semana actual
     *
     * @param $token
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getTareas(Request $request)
    {
        $token = $request->token;

        if(isset($token) == false){
            return response()->json(['message' => 'credenciales invalidas', 'success' => false]);
        }

        try {

            // Obtenemos el usuario con el token
            if (!$user = JWTAuth::toUser($token)) {
                return ['message' => 'Parametro de token incorrectos', 'success' => false];
            }
        }catch (JWTException $exception)
        {
            return ['message'=> $exception->getMessage(), 'success'=> false];
        }

        $semana = new SemanaTarea();
        $tareas = Tarea::getTareaDeLaSemanaPorUser($semana, $user->id);

        return [
            'tareas' => $tareas
        ];
    }

    /**
     * Inserta una nueva hisotricos de fecha del estado de procesos  para las tareas
     *
     * @param $token
     * @param $tarea_id
     * @param array $datos  { fecha: '2017-10-15', estado: 0}
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function setTarea(Request $request)
    {
        $token = $request->token;
        $tarea_id = $request->tarea_id;
        $datos = json_decode($request->datos);
        $tiempo = $request->tiempo;


        $resul = $this->validarParametros($token, $tarea_id, $datos);


        // verificamos que los parametros enviados sean correctos
        if($resul['success'] == false){
            return $resul;
        }

        try {

            // Obtenemos el usuario con el token
            if (!$user = JWTAuth::toUser($token)) {
                return ['message' => 'Parametro de token incorrectos', 'success' => false];
            }
        }catch (JWTException $exception)
        {
            return ['message'=> $exception->getMessage(), 'success'=> false];
        }

        // verificamos si la tarea es correcta del usuarios
        if(!$tarea = Tarea::where('id', '=', $tarea_id)->where('user_id', '=', $user->id)->first())
        {
            return response()->json(['message' => 'parametro tarea incorrecto', 'success' => false]);
        }

        /* Recoremos los datos de las fechas para insertar los historicos */
        foreach ($datos as $item){
            $fecha  = $item->fecha;
            $estado = $item->estado;

            $param =  $this->validarDatosFechas($fecha, $estado);

            if($param['success'] == false)
            {
                return $param;
            }

            try {

                $tareaHistorico = new TareaHistoricoProceso();
                $tareaHistorico->tarea_id = $tarea_id;
                $tareaHistorico->fecha = $fecha;
                $tareaHistorico->estado = $estado;
                $tareaHistorico->save();



            }catch (\Exception $ex){
                return ['message'=> $ex->getMessage(), 'success'=> false];
            }
        }


        // guardamos el tiempo
        $tareaEstado = TareaEstadoTiempo::where('tarea_id', '=', $tarea_id)
                ->where('estado_id', '=', 6)
                ->first();

        if(isset($tareaEstado)== false){
            $tarea_tiempo = new TareaEstadoTiempo();
            $tarea_tiempo->tarea_id = $tarea_id;
            $tarea_tiempo->estado_id = 6;
            $tarea_tiempo->total_tiempo_ultima_actualizacion = $tiempo;
            $tarea_tiempo->save();
        }else{
            $tiempo_total = $tareaEstado->total_tiempo_ultima_actualizacion + $tiempo;

            $tareaEstado->total_tiempo_ultima_actualizacion = $tiempo_total;
            $tareaEstado->save();
        }


        return response()->json(['message' => 'Se guardo los estado, Exito', 'success' => true]);
    }

    /**
     * Validamos los valores de array datos
     *
     * @param $fecha
     * @param $estado
     * @return array
     */
    public function validarDatosFechas($fecha, $estado)
    {
        if (! is_int($estado)  || $estado < 0 || $estado > 1 )
        {
            return ['message' => 'Estado debe estar entre 0 a 1', 'success'=> false];
        }

        $arrFecha = explode(' ', $fecha);
        try{

            if(\Calcana::validarFormatoDB($arrFecha[0]))

            $format = 'Y-m-d H:i:s';
            $date = DateTime::createFromFormat($format, $fecha);
        }catch (\Exception $ex){
            return ['message' => $arrFecha[0], 'success'=> false];
//            return ['message' => 'Formato fecha debe ser igual a \'aaaa-mm-dd hh:mm:ss\'', 'success'=> false];
        }

        return ['message' => 'valores de objeto array Exito', 'success'=> true];
    }

    /**
     * Validar los pranetros la peticion de set de tareas
     *
     * @param $token
     * @param $tarea_id
     * @param $datos
     * @return array
     */
    public function validarParametros($token, $tarea_id, $datos)
    {

        if(isset($token) == false){
            return ['message' => 'token no puede ser nulo', 'success' => false];
        }

        if(isset($tarea_id) == false){
            return ['message' => 'Tarea Id no puede ser nulo', 'success' => false];
        }

        if(!isset($datos)){
            return ['message' => 'Parametro datos no puede ser nulo', 'success' => false];
        }

        if(!is_array($datos)){
            return ['message' => 'Parametro datos no es array', 'success' => false];
        }

        return ['success'=> true, 'message' => 'valicacion de parametro exito'];
    }

}
