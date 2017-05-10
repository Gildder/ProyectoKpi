<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\CalcularSemana;


class TareaRepository
{

    /*contructores */
    public function __construct()
    {
    }

    /* Metodos */
    public static function getTareasProgramadas()
    {
        // Obtenemos las semanas de tareas
        $semanaActual = \Calcana::getSemanasProgramadas(date('Y-m-d'));

        $tareas = Tarea::select('id','descripcion','fechaInicioEstimado','fechaFinEstimado','tiempoEstimado','fechaInicioSolucion','fechaFinSolucion','tiempoSolucion','observaciones','estado','isError','tipo','empleado_id','proyecto_id')
                    ->where('empleado_id','=', \Usuario::get('codigo') )
                    ->where('fechaInicioEstimado','>=', $semanaActual->getDateDB('fechaInicio') )
                    ->whereNull('tareas.deleted_at')
                    ->orderBy('tareas.fechaInicioEstimado', 'desc')
                    ->get();

        return $tareas;
    }

    public static function getTareasArchivados()
    {
        // Obtenemos las semanas de tareas
        $semanaActual = \Calcana::getSemanasProgramadas(date('Y-m-d'));

        $tareas = Tarea::where('empleado_id','=', \Usuario::get('codigo') )
                        ->where('fechaFinEstimado','<', $semanaActual->getDateDB('fechaInicio'))
                        ->whereOr('fechaFinEstimado','>', $semanaActual->getDateDB('fechaInicio'))
                        ->whereNull('tareas.deleted_at')
                        ->get();
        return $tareas;
    }


    public function getTareasEliminados()
    {
        $tareas = Tarea::where('empleado_id','=', \Usuario::get('codigo') )
                        ->whereNotNull('tareas.deleted_at')
                        ->get();

        return $tareas;
    }

    public static function getSemanasTareas($fecha)
    {
        return  \Calcana::getSemanasProgramadas($fecha);
    }
}