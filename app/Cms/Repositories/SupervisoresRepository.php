<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\Semana;
use ProyectoKpi\Models\Empleados\Empleado;


class SupervisoresRepository
{

	/**
	 * Verifica si un empleado es Supervisor.
	 * 
	 * @param  Codigo Empleado
   * @return boolean
	 */
   public static function isSupervisor($param)
   {
   	 	// obtenemos los empelados supoer
      $result = Empleado::
          select('empleados.codigo')
          ->join('supervisor_departamentos','supervisor_departamentos.empleado_id','=','empleados.codigo')
          ->where('supervisor_departamentos.empleado_id', '=', $param)
          ->count();

      if ($result > 0) {
      	return true;
      } else {
      	return false;
      }
        
   }
}