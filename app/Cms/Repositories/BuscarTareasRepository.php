<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 02/09/2017
 * Time: 17:45
 */

namespace ProyectoKpi\Cms\Repositories;


use ProyectoKpi\Http\Requests\Request;

class BuscarTareasRepository
{
    public static function getCargosSupervisados($user_evaluador_id)
    {
        $cargos = \DB::select('call pa_cargosSupervisados_user_id('.$user_evaluador_id.');');

        return $cargos;
    }

    public static function getDepartamentos($user_evaluador_id)
    {
        $departamento = \DB::select('call pa_departamentoSupervisados_user_id('.$user_evaluador_id.');');

        return $departamento;
    }

    public static function getUsuarioSupervisados($user_evaluador_id)
    {
        $departamento = \DB::select('call pa_usuariosSupervisados_user_id('.$user_evaluador_id.');');

        return $departamento;
    }

    public static function filtarTareasParaSupervisores($request)
    {
        $consulta = self::verificarUbicacion($request->ubicacion_id,$request->supervisorid )
            .self::verificarExisteIds('user_id',$request->usuario_id )
            .self::verificarExisteIds('cargo_id',$request->cargo_id )
            .self::verificarExisteIds('departamento_id',$request->departamento_id )
            .self::verificarExisteIds('estado_id',$request->estado_id )
            .self::verificarExisteIds('nro',$request->tarea_nro )
            .self::verificarExisteStr('apellidos',$request->apellido )
            .self::verificarExisteDate(0, $request->fechaInicio,$request->fechaSeleccionada )
            .self::verificarExisteDate(1, $request->fechaFin,$request->fechaSeleccionada );

//        return $consulta;
        $tareas = \DB::select(
            $consulta
        );

        return [
            'tareas' => $tareas
            ];
    }

    private  static function verificarExisteIds($key, $value)
    {
        $result = '';
        if(isset($value) && empty($value) == false){
            $result =  'AND '.$key. ' = '.$value;
        }

        return $result;
    }

    private  static function verificarExisteStr($key, $value)
    {
        $result = '';
        if(isset($value)&& empty($value)== false){

            $result =  'AND '.$key. ' LIKE \''.$value.'%\'';
        }

        return $result;
    }

    private  static function verificarExisteDate($key, $value, $selecion)
    {
        $result = '';
        $buscada = '';
        $fecha = '';
        $operador = '';
        if($selecion == 1){
            $buscada = 'Estimado';
        }else{
            $buscada = 'Solucion';
        }

        if($key == 0){
            $fecha = 'fechaInicio';
            $operador = '>=';
        }else{
            $fecha = 'fechaFin';
            $operador = '<=';
        }

        if(isset($value) && empty($value)== false){

            $result =  'AND '.$fecha.$buscada. ' '.$operador.' \''.$value.'\'' ;
        }

        return $result;
    }

    private  static function verificarUbicacion($value, $supervisorid)
    {
        if (isset($value) && empty($value)== false){
            return 'select *
                from (
                select *
                from vw_tareas_usuario tu
                where tu.user_id in (
                    select u.id
                    from supervisor_cargos sc
                    inner join users u on u.cargo_id = sc.cargo_id
                    where sc.user_id = '.$supervisorid.'  
                    union all
                    select u.id
                    from supervisor_departamentos sd 
                    inner join users u on u.departamento_id = sd.departamento_id
                    where sd.user_id = '.$supervisorid.'
                    order by u.id
                )
                ) as y
                where y.tarea_id in (
                    SELECT tl.tarea_id
                    from tarea_localizacion tl
                    where tl.localizacion_id = '.$value.'
                
                )';
        }else{
            return 'select *
            from vw_tareas_usuario tu
            where tu.user_id in (
                select u.id
                from supervisor_cargos sc
                inner join users u on u.cargo_id = sc.cargo_id
                where sc.user_id =  '.$supervisorid.'
                union all
                select u.id
                from supervisor_departamentos sd 
                inner join users u on u.departamento_id = sd.departamento_id
                where sd.user_id = '.$supervisorid.'
                order by u.id
              )';
        }
    }

}
