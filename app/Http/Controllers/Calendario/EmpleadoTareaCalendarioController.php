<?php

namespace ProyectoKpi\Http\Controllers\Calendario;

use Carbon\Carbon;
use function count;
use function date;

use Illuminate\Http\Request;
use function json_encode;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use ProyectoKpi\Http\Controllers\Controller;
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
}
