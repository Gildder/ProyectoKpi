<?php

namespace ProyectoKpi\Http\Controllers\Procesos;

use Illuminate\Http\Request;

use ProyectoKpi\Cms\Clases\Caches;
use ProyectoKpi\Cms\Repositories\AprobacionRepository;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Models\Evaluadores\Evaluador;
use ProyectoKpi\Models\Procesos\OpcionAprobacion;

class AprobacionesController extends Controller
{
     public function index()
     {

     	$evaluadores =  Evaluador::all();
//     	dd($evaluadores);
     	return view('procesos.aprobaciones.index',
            [
                'evaluadores' => $evaluadores
            ]);
     }

    public function show($id)
    {
        $evaluador  = Evaluador::findOrFail($id);
        $opciones = OpcionAprobacion::all();

        return view('procesos.aprobaciones.opciones.index',
            [
                'opciones' => $evaluador->opcionAprobaciones,
                'opcionesDisponibles' => $opciones,
                'usuarios' => [],
                'evaluador' => $evaluador
            ]
        );
    }


    public function buscarUsuario(Request $request)
    {
        $usuarios = Evaluador::buscarUsuario($request->nombre, $request->apellido);

        return response()->json(['usuarios'=> $usuarios]);
    }

    public function guardarAprobador(Request $request)
    {
        return Evaluador::guardarAprobador($request->evaluador_id, $request->opcion_id, $request->user_id);

    }


    public function opcionesAprobacion(Request $request)
    {
        $resultado =  Evaluador::opcionesAprobacion($request->evaluador_id);

        return $resultado['opciones'];
    }


}
