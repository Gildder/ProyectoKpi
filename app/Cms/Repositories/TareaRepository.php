<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\Semana;


class TareaRepository
{


    /*contructores */
    public function __construct()
    {
       
    }
    // /* Metodos */
    public function getTareasProgramadas()
    {
        $user = Auth::user();  //obtenemos el usuario logueado
        $semana = new Semana;
        $semanaprogramada = $semana->getSemanasProgramadas(date('Y-m-d'));
        $tareas = Tarea::where('tipo','=','1')->where('empleado_id','=', $user->empleado->codigo )
                        ->where('fechaInicioEstimado','>=', $semanaprogramada[0]['fechaInicio'])
                        ->where('fechaFinEstimado', '<=', $semanaprogramada[0]['fechaFin'])
                        ->whereNull('tareas.deleted_at')
                        ->get();

        return $tareas;
    }

    public function getTareasArchivados()
    {
        $user = Auth::user();  //obtenemos el usuario logueado
        $semana = new Semana;
        $semanaprogramada = $semana->getSemanasProgramadas(date('Y-m-d'));

        $tareas = Tarea::where('tipo','=', '1')->where('empleado_id','=', $user->empleado->codigo )
                        ->where('fechaFinEstimado','<', $semanaprogramada[0]['fechaFin'])
                        ->whereNull('tareas.deleted_at')
                        ->get();

        return $tareas;
    }


    public function getTareasEliminados()
    {
        $user = Auth::user();  //obtenemos el usuario logueado

        $tareas = Tarea::where('tipo', '=','1')->where('empleado_id','=', $user->empleado->codigo )
                        ->whereNotNull('tareas.deleted_at')
                        ->get();

        return $tareas;
    }

    public function listSemana($fecha)
    {
        $semana = new Semana();
        return  $semana->getSemanasProgramadas($fecha);
    }
}