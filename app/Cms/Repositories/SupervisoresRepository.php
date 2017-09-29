<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use ProyectoKpi\Models\Empleados\Supervisados;
use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\CalcularSemana;
use ProyectoKpi\Models\Empleados\Empleado;

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
        $usuarios = self::usuariosSupervisados();
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

    public static function usuariosSupervisados()
    {
        return \DB::select('call pa_supervisores_empleadosSupervisadosEmpleado('.\Usuario::get('id').');');
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
