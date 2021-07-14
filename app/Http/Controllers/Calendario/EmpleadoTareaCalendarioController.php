<?php

namespace ProyectoKpi\Http\Controllers\Calendario;

use Carbon\Carbon;

use Httpful\Response;
use Illuminate\Http\Request;
use Mockery\Exception;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use ProyectoKpi\Cms\Semanas\SemanaTarea;
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
		$estados = Tarea::getEstados();
		$semanas = new SemanaTarea();

        return view('calendario.empleado.index', [
            'estados' => $estados,
            'diaHoy'=> Carbon::now()->toDateString(),
            'semanas' => $semanas->getSemana(),
            'agenda' => 0,
        ]);
    }

    public function cargarTareas()
    {
        ini_set('max_execution_time', 300);

		return Tarea::getTareasCalendar(new SemanaTarea());
    }

    /* Tarea de comunes para response de Ajax */
    public function getTareaComunes()
    {
        $tareas = Tarea::getTareasComunes();

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
        $resultado = Tarea::validarTarea($request);

        if($resultado['success'])
        {
                return Tarea::guardar($request);
        }else{
            return $resultado;
        }
    }
}
