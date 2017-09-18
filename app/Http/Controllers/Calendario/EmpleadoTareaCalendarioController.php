<?php

namespace ProyectoKpi\Http\Controllers\Calendario;

use Carbon\Carbon;
use function count;
use function date;

use function json_encode;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use ProyectoKpi\Http\Controllers\Controller;

class EmpleadoTareaCalendarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listaMiTareas()
    {
		$estados = TareaRepository::getEstados();

//        dd(TareaRepository::getTareasCalendar(\Usuario::get('id')));

//		dd(Carbon::now()->toDateString());
        return view('calendario.empleado.index', ['estados' => $estados, 'diaHoy'=> Carbon::now()->toDateString()]);
    }

    public function cargarTareas()
    {
        ini_set('max_execution_time', 300);

		return TareaRepository::getTareasCalendar(\Usuario::get('id'));
    }
}
