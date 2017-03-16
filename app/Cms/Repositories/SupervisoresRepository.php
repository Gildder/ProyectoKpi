<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\CAche;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\Semana;
use ProyectoKpi\Models\Empleados\Empleado;


class SupervisoresRepository
{

    /*contructores */
    public function __construct()
    {
       
    }


    /* 
     * VErificar si el usuario logueado esata asignado como supervisor de otro emplaedo
     * gaurda en cache si es asi.
      */
    public static function isSupervisor()
    {
        $user = Auth::user();//obtenemos el usuario logueado
        
        if ($user->name = 'admin') {
            Cache::forever('depasores', '');
            return 0;
        }

        // obtenemos los empelados supoer
        $result = Empleado::
            select('empleados.codigo')
            ->join('supervisor_departamentos','supervisor_departamentos.empleado_id','=','empleados.codigo')
            ->where('supervisor_departamentos.empleado_id', '=', $user->empleado->codigo)
            ->count();

        if ($result > 0 ) {
            Cache::forever('depasores', encrypt($user->empleado->codigo));
        }else{
            Cache::forever('depasores', '');
        }

        return $result;
    }
}