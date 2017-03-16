<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\CAche;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\Semana;
use ProyectoKpi\Models\Empleados\Empleado;


class EvaluadoresRepository
{

    /*contructores */
    public function __construct()
    {
       
    }


    /* 
     * VErificar si el usuario logueado esata asignado como supervisor de otro emplaedo
     * gaurda en cache si es asi.
      */
    public static function isEvaluador()
    {
        $user = Auth::user();//obtenemos el usuario logueado
        
        if ($user->name = 'admin') {
            Cache::forever('depasores', '');
            return 0;
        }


        // obtenemos los empelados supoer
        $result = Empleado::select('evaluador_empleados.evaluador_id')
            ->join('evaluador_empleados','evaluador_empleados.empleado_id','=','empleados.codigo')
            ->where('evaluador_empleados.empleado_id', '=', $user->empleado->codigo)
            ->first();

        if (! is_null($result)) 
        {
            Cache::forever('evadores', $result);
        }else{
            Cache::forever('evadores', '');
        }

        return $result;
    }


    public static function getEvaluados($gerencia)
    {
 
        $evaluados = DB::table('evaluador_cargos')
    ->select('empleados.codigo', 'empleados.nombres', 'empleados.apellidos', 'departamentos.nombre as departamento', 'users.name as usuario', 'users.email as correo', 'cargos.nombre as cargo')
    ->join('cargos', 'cargos.id', '=', 'evaluador_cargos.cargo_id')
    ->join('empleados', 'empleados.cargo_id', '=', 'evaluador_cargos.cargo_id')
    ->join('departamentos', 'departamentos.id', '=', 'empleados.departamento_id')
    ->join('users', 'users.id', '=', 'empleados.user_id')
    ->where('evaluador_cargos.evaluador_id', $gerencia)
    ->get();

        return $evaluados;
    }
}