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
        $user = Auth::user();  //obtenemos el usuario logueado

        // Obtenemos las semanas de tareas
        $semanaprogramada = \Calcana::getSemanasProgramadas(date('Y-m-d'));


        dd($semanaprogramada);

        $tareas = Tarea::select('id','descripcion','fechaInicioEstimado','fechaFinEstimado','tiempoEstimado','fechaInicioSolucion','fechaFinSolucion','tiempoSolucion','observaciones','estado','isError','tipo','empleado_id','proyecto_id')
                    ->where('empleado_id','=', $user->empleado->codigo )
                    ->where('fechaInicioEstimado','>=', $semanaprogramada->fechaFin)
                    ->whereNull('tareas.deleted_at')
                    ->orderBy('tareas.fechaInicioEstimado', 'desc')
                    ->get();

        return $tareas;
    }

    public static function getTareasArchivados()
    {
        $user = Auth::user();  //obtenemos el usuario logueado
        $semana = new CalcularSemana;

        $semanaprogramada = $semana->getSemanasProgramadas(date('Y-m-d'));

        $tareas = Tarea::where('empleado_id','=', $user->empleado->codigo )
                        ->where('fechaFinEstimado','<', $semanaprogramada[0]->fechaFin)
                        ->whereOr('fechaFinEstimado','>', $semanaprogramada[0]->fechaFin)
                        // ->where('fechaFinEstimado','>', $semanaprogramada[0]['fechaFin'])
                        ->whereNull('tareas.deleted_at')
                        ->get();

                        // dd($semanaprogramada);

        return $tareas;
    }


    public function getTareasEliminados()
    {
        $user = Auth::user();  //obtenemos el usuario logueado

        $tareas = Tarea::where('empleado_id','=', $user->empleado->codigo )
                        ->whereNotNull('tareas.deleted_at')
                        ->get();

        return $tareas;
    }

    public static function getSemanasTareas($fecha)
    {
        return  Calcana::getSemanasProgramadas($fecha);
    }
}