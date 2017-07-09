<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\CalcularSemana;
use ProyectoKpi\Models\Empleados\Empleado;

class SupervisoresRepository
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
}
