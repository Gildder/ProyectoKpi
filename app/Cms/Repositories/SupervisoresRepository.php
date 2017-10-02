<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Models\Empleados\Empleado;
use Psy\Exception\ErrorException;

trait SupervisoresRepository
{

    /**
     * Verifica si un empleado es Supervisor.
     *
     * @param  Codigo Empleado
     * @return boolean
     */
    public static function verificarSupervisor($param)
    {
        // obtenemos los empelados supoer
        $deparCount = DB::
            table('supervisor_departamentos')
            ->where('supervisor_departamentos.user_id', '=', $param)
            ->count();

        $cargoCount = DB::
            table('supervisor_cargos')
            ->where('supervisor_cargos.user_id', '=', $param)
            ->count();

        if ($deparCount > 0  || $cargoCount > 0) {
           return true;
        } else {
           return false;
        }
    }

    /**
     * obtenemos las tareas de los supervisores
    */
    public static function getTareasSupervisados($agenda)
    {
        $semanas = Tarea::obtenerSemanaDelAnio($agenda);

        // obtenemos los usuarios supervisados
        $usuarios = self::usuariosSupervisados(\Usuario::get('id'));
        $lista = array();
        foreach ($usuarios as $usuario){
            $tareas = self::getTareasProgramadasSupervisados($usuario->id, $semanas->fechaInicio, $semanas->fechaFin);

            // recorremos las tareas de los usuarios y los  tareas juntamos las tareas
            foreach ($tareas as $item) {
                array_push($lista, $item);
            }
        }

        array_push($lista, $semanas);

        return $lista;
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

        $query = self::queryValidaBuscar($request);

        $user_id = (String) \Auth::user()->id;
        $arQuery =  "(vw_filtro_tarea_supervisadas.sup_car = ".$user_id." OR vw_filtro_tarea_supervisadas.sup_dep = ".$user_id.") ". $query;

//        dd($arQuery);

        try{
            $tareas = DB::table('vw_filtro_tarea_supervisadas')
                ->select(DB::raw(' distinct(tarea_id), nro, descripcion, fechaInicio, fechaFin, tiempo, observaciones, estado_id, estado, colorEstado, textoEstado,
tipo_id, tipo,isError, user_id, codigo, colorUser, textoUser, usuario, activo, vacacion, bloqueado, nombres, apellidos, correo, cargo_id,
cargo,departamento_id, departamento, localizacion_id, localizacion, updated_at, sup_car,sup_dep,ubicacion_id, ubicacion'))
                ->whereRaw($arQuery)
                ->orderBy('vw_filtro_tarea_supervisadas.nro', 'desc')
                ->get();

            return ['tareas'=> $tareas, 'success'=> true];
        }catch (ErrorException $err){
            return ['success'=> false];
        }

    }

    protected static function queryValidaBuscar($request)
    {
        $query = "";


        if($request->usuario_id != "") {
            if($query != ""){
                $query = $query ." AND ";
            }
            $query = ' vw_filtro_tarea_supervisadas.user_id = ' . (String) $request->usuario_id;

        }

        if($request->apellidos != "") {
            if($query != ""){
                $query = $query ." AND ";
            }
            $query = $query . ' vw_filtro_tarea_supervisadas.apellidos like \'' . (String) $request->apellidos . '\'%';
        }

        if($request->cargo_id != "") {
            if($query != ""){
                $query = $query ." AND ";
            }

            $query = $query . ' vw_filtro_tarea_supervisadas.cargo_id = ' . (String) $request->cargo_id ;
        }

        if($request->departamento_id != "") {
            if($query != ""){
                $query = $query ." AND ";
            }

            $query = $query . ' vw_filtro_tarea_supervisadas.departamento_id = ' . (String) $request->departamento_id;
        }
        if($request->tarea_id != "") {
            if($query != ""){
                $query = $query ." AND ";
            }

            $query = $query . ' vw_filtro_tarea_supervisadas.tarea_id = ' . (integer) $request->tarea_id ;
        }
        if($request->localizacion_id != "") {
            if($query != ""){
                $query = $query ." AND ";
            }

            $query = $query . ' vw_filtro_tarea_supervisadas.ubicacion_id = ' . (String) $request->localizacion_id ;
        }
        if($request->fechaInicio != "") {
            if($query != ""){
                $query = $query ." AND ";
            }
            $query = $query . ' STR_TO_DATE(vw_filtro_tarea_supervisadas.fechaInicio, \'%d/%m/%Y\') >= STR_TO_DATE(\''.$request->fechaInicio.'\', \'%d/%m/%Y\')';
        }

        if($request->fechaFin != "") {
            if($query != ""){
                $query = $query ." AND ";
            }
            $query = $query . ' STR_TO_DATE(vw_filtro_tarea_supervisadas.fechaFin, \'%d/%m/%Y\') >= STR_TO_DATE(\''.$request->fechaFin.'\', \'%d/%m/%Y\')';
        }

        if($request->estado_id != "") {
            if($query != ""){
                $query = $query ." AND ";
            }

            $query = $query . ' vw_filtro_tarea_supervisadas.estado_id = ' . (String)  $request->estado_id ;
        }

        if($query != ""){
            $query = " AND ".$query;
        }

        return (String) $query;

    }

    public static function usuariosSupervisados($user_id)
    {
        return \DB::select('call pa_supervisores_empleadosSupervisadosEmpleado('.$user_id.');');
    }

    public static function cargosSupervisados($user_id)
    {
        return \DB::select('call pa_supervosores_cargosSupervisados('.$user_id.');');
    }

    public static function departamentosSupervisados($user_id)
    {
        return \DB::select('call pa_supervisores_departamentosSupervisados('.$user_id.');');
    }

    public static function getTareasProgramadasSupervisados($usuario_id, $fechaInicio, $fechaFin)
    {
        $tareas = \DB::table('vw_tareas_supervisados')
            ->where('vw_tareas_supervisados.user_id', '=', $usuario_id)
            ->where(DB::raw('STR_TO_DATE(vw_tareas_supervisados.fechaInicio, \'%d/%m/%Y\')') ,'>=', DB::Raw('STR_TO_DATE(\''.$fechaInicio.'\', \'%d/%m/%Y\')'))
            ->where(DB::raw('STR_TO_DATE(vw_tareas_supervisados.fechaFin, \'%d/%m/%Y\')') ,'<=', DB::Raw('STR_TO_DATE(\''.$fechaFin.'\', \'%d/%m/%Y\')'))
            ->orderBy('vw_tareas_supervisados.nro', 'desc')
            ->get();

        return $tareas;
    }



}
