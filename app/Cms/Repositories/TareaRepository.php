<?php 
namespace ProyectoKpi\Cms\Repositories;

use DebugBar\DebugBar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Mockery\CountValidator\Exception;
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

        $tareas = Tarea::select('tareas.id', 'tareas.descripcion', 'tareas.fechaInicioEstimado', 'tareas.fechaFinEstimado', 'tareas.tiempoEstimado', 'tareas.fechaInicioSolucion', 'tareas.fechaFinSolucion', 'tareas.tiempoSolucion',
                        'tareas.observaciones', 'estado_tareas.nombre as estado', 'tareas.isError', 'tarea_tipos.nombre as tipo', 'tareas.proyecto_id')
                    ->leftjoin('estado_tareas', 'estado_tareas.id','=', 'tareas.estadoTarea_id')
                    ->leftjoin('tarea_tipos', 'tarea_tipos.id','=', 'tareas.tipoTarea_id')
                    ->where('user_id', '=', \Usuario::get('id'))
                    ->where('fechaInicioEstimado', '>=', $semanaActual->getDateDB('fechaInicio'))
                    ->whereNull('tareas.deleted_at')
                    ->orderBy('tareas.fechaInicioEstimado', 'desc')
                    ->get();

        return $tareas;
    }

    public static function getTareasArchivados()
    {
        try{

            // Obtenemos las semanas de tareas
            $semanaActual = \Calcana::getSemanasProgramadas(date('Y-m-d'));

            $tareas = Tarea::where('user_id', '=', \Usuario::get('id'))
                            ->where('fechaFinEstimado', '<', $semanaActual->getDateDB('fechaInicio'))
                            ->whereOr('fechaFinEstimado', '>', $semanaActual->getDateDB('fechaInicio'))
                            ->whereNull('tareas.deleted_at')
                            ->get();
            return $tareas;
        }catch (Exception $e){
            DebugBar::error('Error: '.$e.', getTareasArchivadas');
        }
    }


    public function getTareasEliminados()
    {
        $tareas = Tarea::where('user_id', '=', \Usuario::get('id'))
                        ->whereNotNull('tareas.deleted_at')
                        ->get();

        return $tareas;
    }

    public static function getSemanasTareas($fecha)
    {
        return  \Calcana::getSemanasProgramadas($fecha);
    }
}
