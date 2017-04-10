<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\Semana;
use ProyectoKpi\Models\Empleados\Empleado;


class EvaluadoresRepository
{

    /*contructores */
    public function __construct()
    {
       
    }

    public static function getEvaluados($evaluador_id, $empleado_id)
    {
 
        $evaluados = DB::table('evaluador_cargos')
            ->select('empleados.codigo', 'empleados.nombres', 'empleados.apellidos', 'departamentos.nombre as departamento', 'users.name as usuario', 'users.email as correo', 'cargos.nombre as cargo', 'evaluadores.descripcion as gerencia')
            ->join('cargos', 'cargos.id', '=', 'evaluador_cargos.cargo_id')
            ->join('empleados', 'empleados.cargo_id', '=', 'evaluador_cargos.cargo_id')
            ->join('departamentos', 'departamentos.id', '=', 'empleados.departamento_id')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->join('evaluadores', 'evaluadores.id', '=', 'evaluador_cargos.evaluador_id')
            ->join('evaluador_empleados', 'evaluador_empleados.evaluador_id', '=', 'evaluador_cargos.evaluador_id')
            ->where('empleados.codigo', '<>', $empleado_id)
            ->where('evaluador_empleados.evaluador_id',  $evaluador_id)
            ->get();

        return $evaluados;
    }

    /**
     * Verifica si un empleado es Supervisor.
     * 
     * @param  Codigo Empleado
     * @return boolean
     */
    public static function verificarsEvaluador($param)
    {
        // obtenemos los empelados supoer
        $result = Empleado::select('evaluador_empleados.evaluador_id')
            ->join('evaluador_empleados','evaluador_empleados.empleado_id','=','empleados.codigo')
            ->where('evaluador_empleados.empleado_id', '=', $param)
            ->first();

        return $result;
        

    }
}