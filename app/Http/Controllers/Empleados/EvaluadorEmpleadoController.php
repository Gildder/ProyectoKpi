<?php

namespace ProyectoKpi\Http\Controllers\Empleados;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Http\Requests;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Models\Empleados\Evaluador;
use ProyectoKpi\Http\Models\Empleados\EvaluadorEmpleado;



class EvaluadorEmpleadoController extends Controller
{
	public function __contruct()
   	{
   		$this->middleware('auth');
   	}

   	
    public function index()
	{
		$evaluadores = Evaluador::all();

		return view('empleados/evaluadorempleados/index', ['evaluadores'=> $evaluadores]);
	}

	public function show($id)
	{
		$empleadosDisponibles = DB::select('call pa_evaluadores_empleadosDisponibles('.$id.');');
        $empleadosEvaluadores = DB::select('call pa_evaluadores_empleadosEvaluadores('.$id.');');

		$evaluador = Evaluador::findOrFail($id);
				
		return view('empleados/evaluadorempleados/show',['evaluador'=>$evaluador,'empleadosdis'=>$empleadosDisponibles,'empleadosup'=>$empleadosEvaluadores]);
	}


	/* Cargos Evaluados*/

}
