<?php

namespace ProyectoKpi\Http\Controllers\Tareas;

use Illuminate\Http\Request;

use ProyectoKpi\Cms\Repositories\BuscarTareasRepository;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Models\Localizaciones\Localizacion;
use ProyectoKpi\Models\Tareas\Estados;

class BuscarTareaController extends Controller
{
    public function listaSupervidor()
    {
        $ubicaciones = Localizacion::all()->toJson();
        $usuarios = BuscarTareasRepository::getUsuarioSupervisados(\Usuario::get('id'));
        $estados = Estados::all()->toJson();
        $cargos = BuscarTareasRepository::getCargosSupervisados(\Usuario::get('id'));
        $departamentos = BuscarTareasRepository::getDepartamentos(\Usuario::get('id'));
        $tareas = null;

//        dd(\DB::select('select * from tareas'));
//        dd(\Usuario::get('id'), $localizaciones, $estados, $cargos, $departamentos);

        return view('supervisores/supervisados/tareas/buscar',
            [
                'tareas' => $tareas,
                'ubicaciones' => $ubicaciones,
                'estados'=> $estados,
                'usuarios'=> json_encode($usuarios),
                'cargos'=> json_encode($cargos),
                'departamentos'=> json_encode($departamentos)
            ]);
    }

    public function buscarTareasSupervisadas(Request $tarea)
    {
       return  BuscarTareasRepository::filtarTareasParaSupervisores($tarea);
    }
}

