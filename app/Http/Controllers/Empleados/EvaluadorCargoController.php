<?php

namespace ProyectoKpi\Http\Controllers\Empleados;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Models\Empleados\Evaluador;
use ProyectoKpi\Models\Empleados\EvaluadorCargo;
use ProyectoKpi\Models\Empleados\Cargo;
use Illuminate\Support\Facades\DB;


class EvaluadorCargoController extends Controller
{
    public function index()
	{
		// $evaluadores = EvaluadorCargo::getEvaluadores();
		$evaluadores = Evaluador::all();

		return view('empleados/evaluadorcargos/index', ['evaluadores'=> $evaluadores]);
	}

	public  function show($id)
	{
		$cargosDisponibles = DB::select('call pa_evaluadores_cargosDisponibles('.$id.');');
        $cargosEvaluadores = DB::select('call pa_evaluadores_cargosEvaluados('.$id.');');

		$evaluador = Evaluador::findOrFail($id);
				
		return view('empleados/evaluadorcargos/show',['evaluador'=>$evaluador,'empleadosdis'=>$cargosDisponibles,'empleadosup'=>$cargosEvaluadores]);
	}


	/* Cargos Evaluados*/

	 public function cargosevaluados()
	{
		$evaluadores = Evaluador::all();

		return view('empleados/evaluador/index', ['evaluadores'=> $evaluadores]);
	}


	public function agregarcargo($cargo_id, $eva_id)
    {
        DB::table('evaluador_cargos')->insert(
            array('cargo_id' => $cargo_id, 'evaluador_id' => $eva_id)
        );

        return $this->show($eva_id);
    }

    public function quitarcargo($cargo_id, $eva_id)
    {
        DB::table('evaluador_cargos')->where('cargo_id', $cargo_id)->where('evaluador_id', $eva_id)->delete();

        return $this->show($eva_id);
    }
}
