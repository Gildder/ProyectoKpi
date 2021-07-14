<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 29/10/2017
 * Time: 14:09
 */

namespace ProyectoKpi\Cms\Repositories;


use ProyectoKpi\Models\Evaluadores\Evaluador;
use ProyectoKpi\Models\User;

trait AprobacionRepository
{
    public static function EvaluadoresAprobacion()
    {
         $evaluadores = Evaluador::all();

        return $evaluadores;
    }


    public static function buscarUsuario($nombre, $apellido)
    {
        return User::select('id', 'nombres', 'apellidos', 'email as correo')
            ->where('nombres', 'LIKE',"$nombre%")
            ->where('apellidos', 'LIKE',"$apellido%")
            ->where('active', '=', '1')
            ->whereNull('deleted_at')
            ->get();


    }

    public static function guardarAprobador($evaluador_id, $opcion_id, $user_id)
    {
        $id = \DB::table('opcion_aprobacion_evaluadores')->insertGetId(
            [
                'opcion_id' => $evaluador_id,
                'evaluador_id' => $opcion_id,
                'user_id' => $user_id
            ]
        );

        if(isset($id)){
            return response()->json(['success' => true, 'message'=> 'Exito']);
        }else{
            return response()->json(['success'=> false, 'message'=> 'Error']);
        }
    }

    public static function opcionesAprobacion($evaluador_id)
    {
        $opciones = \DB::table('opcion_aprobacion_evaluadores')
            ->join('opcion_aprobaciones', 'opcion_aprobaciones.id', '=', 'opcion_aprobacion_evaluadores.opcion_id')
            ->join('users', 'users.id', '=', 'opcion_aprobacion_evaluadores.user_id')
            ->where('evaluador_id', '=', $evaluador_id)
            ->whereNull('deleted_at')
            ->select(
                'opcion_aprobacion_evaluadores.id',
                'opcion_aprobacion_evaluadores.evaluador_id',
                'opcion_aprobacion_evaluadores.user_id  as user_id',
                'users.nombres  as nombre',
                'users.apellidos  as apellido',
                'opcion_aprobacion_evaluadores.opcion_id  as opcion_id',
                'opcion_aprobaciones.descripcion  as opcion'
            )
            ->get();


        return resposne()->json(['success'=> true, 'opciones'=> $opciones]);
    }


}
