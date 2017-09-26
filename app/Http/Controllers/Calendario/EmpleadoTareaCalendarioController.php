<?php

namespace ProyectoKpi\Http\Controllers\Calendario;

use Carbon\Carbon;

use Httpful\Response;
use Illuminate\Http\Request;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Http\Requests\Tareas\TareaProgramasFormRequest;
use ProyectoKpi\Models\Tareas\Tarea;


class EmpleadoTareaCalendarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listaMiTareas()
    {
		$estados = TareaRepository::getEstados();
		$semanas = TareaRepository::obtenerSemanaDelAnio(0);
//dd($this->getTareaComunes());
//        dd(Tarea::getTareasCalendar(\Usuario::get('id')));

//		dd(Carbon::now()->toDateString());
        return view('calendario.empleado.index', ['estados' => $estados, 'diaHoy'=> Carbon::now()->toDateString(), 'semanas' => $semanas, 'agenda' => 0 ]);
    }

    public function cargarTareas()
    {
        ini_set('max_execution_time', 300);


		return Tarea::getTareasCalendar(\Usuario::get('id'));
    }

    /* Tarea de comunes para response de Ajax */
    public function getTareaComunes()
    {
        $tareas = Tarea::getTareasComunes(\Usuario::get('id'));

        return ['tareas' => $tareas ];
    }

    public function guardarTareaComun(Request $request)
    {
        $tareas = Tarea::storeTareaComunes($request->titulo, $request->color);

        return ['tareas' => $tareas ];
    }

    public function eliminarTareaComun(Request $request)
    {
        $tareas = Tarea::deleteTareaComunes($request->id);

        return ['tareas' => $tareas ];
    }

    public function guardarTarea(TareaProgramasFormRequest $request)
    {
        if($request->ajax()){
            $result = Tarea::guardar($request);

            if ($result['success']){
                return response()->json($result);
            }else{
                return response()->json($result);
            }
        }
    }
}
