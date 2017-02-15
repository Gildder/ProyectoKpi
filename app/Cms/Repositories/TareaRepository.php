<?php namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\Semana;


class TareaRepository
{
    protected $semanaprogramada;


    /*contructores */
    public function __construct()
    {
        $semana = new Semana;
        $this->semanaprogramada = $semana->getSemanasProgramadas(date('Y-m-d'));
    }
    // /* Metodos */


    public function getTareasProgramadas()
    {
        $user = Auth::user();  //obtenemos el usuario logueado
        
        $tareas = Tarea::where('tipo','=', '1')->where('empleado_id', $user->empleado->codigo )
                        ->where('fechaInicioEstimado','>=', $this->semanaprogramada[0]['fechaInicio'])
                        // ->where('fechaFinEstimado', '<=', $this->semanaprogramada[0]['fechaFin'])
                        ->whereNull('tareas.deleted_at')
                        ->get();

        return $tareas;
    }

    public function getTareasArchivados()
    {
        $user = Auth::user();  //obtenemos el usuario logueado
        $semana = new Semana;
        $semanaprogramada = $semana->getSemanasProgramadas(date('Y-m-d'));

        $tareas = Tarea::where('tipo','=', '1')->where('empleado_id', $user->empleado->codigo )
                        ->where('fechaInicioEstimado','<', $this->semanaprogramada[0]['fechaInicio'])
                        ->whereNull('tareas.deleted_at')
                        ->get();

        return $tareas;
    }


    public function getTareasEliminados()
    {
        $user = Auth::user();  //obtenemos el usuario logueado

        $tareas = Tarea::where('tipo','=', '1')->where('empleado_id', $user->empleado->codigo )
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