<?php

namespace ProyectoKpi\Http\Controllers\Indicadores;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use ProyectoKpi\Http\Requests;

use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\Frecuencia;
use ProyectoKpi\Models\Indicadores\IndicadorCargo;
use ProyectoKpi\Http\Requests\Indicadores\IndicadorCargoFormRequest;


class IndicadorCargoController extends Controller
{
	public function __contruct()
   	{
   		$this->middleware('auth');
   	}
   
    public function index()
	{
		$indicadores = Indicador::select('indicadores.id', 'indicadores.nombre','indicadores.descripcion_objetivo' , 'tipos_indicadores.nombre as tipo')->join('tipos_indicadores','tipos_indicadores.id','=','indicadores.tipo_indicador_id')->whereNull('indicadores.deleted_at')->get();;

		return view('indicadores/indicadorcargos/index', ['indicadores'=> $indicadores]);
	}

	public  function show($id)
	{
		$cargosDisponibles = DB::select('call pa_indicadores_cargosDisponibles('.$id.');');
        $cargosEvaluadores = DB::select('call pa_indicadores_cargosIndicadores('.$id.');');

		$indicador = Indicador::findOrFail($id);
				
		return view('indicadores/indicadorcargos/show',['indicador'=>$indicador,'cargosDisponibles'=>$cargosDisponibles,'cargosEvaluadores'=>$cargosEvaluadores]);
	}

	public function editar($cargo_id, $ind_id)
	{
		$cargo = Cargo::findOrFail($cargo_id);
    	$indicador = Indicador::findOrFail($ind_id);
    	$frecuencia = Frecuencia::all();
    	$indicadorcargo = IndicadorCargo::where('indicador_id', $ind_id)->where('cargo_id', $cargo_id)->first();

        return view('indicadores.indicadorcargos.edit',['frecuencia'=>$frecuencia, 'indicador'=>$indicador, 'cargo'=>$cargo, 'indicadorcargo'=> $indicadorcargo]);
	}


	public function update(IndicadorCargoFormRequest $Request,  $cargo_id, $ind_id)
	{
			DB::table('indicador_cargos')
            ->where('indicador_id', $ind_id)->where('cargo_id', $cargo_id)
            ->update([
            	'condicion' => trim(\Request::input('condicion')),
            	'aclaraciones' => trim(\Request::input('aclaraciones')),
            	'objetivo' => trim(\Request::input('objetivo')),
				'frecuencia_id' => \Request::input('frecuencia_id'),
            	]);

		return redirect('indicadores/indicadorcargos/'.$ind_id)->with('message', 'Se modifico el cargo '.$cargo_id.' correctamente.');
	}

	public function store(IndicadorCargoFormRequest $Request)
	{
		$indicadorcargo = new IndicadorCargo;
		$indicadorcargo->indicador_id = \Request::input('indicador_id');
		$indicadorcargo->cargo_id = \Request::input('cargo_id');
		$indicadorcargo->condicion = trim(\Request::input('condicion'));
		$indicadorcargo->aclaraciones = trim(\Request::input('aclaraciones'));
		$indicadorcargo->objetivo = trim(\Request::input('objetivo'));
		$indicadorcargo->frecuencia_id = \Request::input('frecuencia_id');
		$indicadorcargo->save();

		return redirect('indicadores/indicadorcargos/'.$indicadorcargo->indicador_id)->with('message', 'Se agrego el cargo '.$indicadorcargo->cargo_id.' correctamente.');

	}

	public function destroy($cargo_id, $ind_id)
	{
		DB::table('indicador_cargos')->where('indicador_id', $ind_id)->where('cargo_id', $cargo_id)->delete();
    	$indicador = Indicador::findOrFail($ind_id);

		return redirect('indicadores/indicadorcargos/'.$ind_id)->with('message', 'Se quito el cargo '.$ind_id.' correctamente.');


	}

	/* Cargos Evaluados*/

	public function cargosevaluados()
	{
		$evaluadores = Evaluador::all();

		return view('empleados/evaluador/index', ['evaluadores'=> $evaluadores]);
	}


	public function agregarcargo($cargo_id, $indicador_id)
    {
    	$cargo = Cargo::findOrFail($cargo_id);
    	$indicador = Indicador::findOrFail($indicador_id);
    	$frecuencia = Frecuencia::all();

        return view('indicadores.indicadorcargos.create',['frecuencia'=>$frecuencia, 'indicador'=>$indicador, 'cargo'=>$cargo]);
    }

    public function quitarcargo($cargo_id, $indicador_id)
    {
    	var_dump('ver');
        DB::table('indicador_cargos')->where('cargo_id', $cargo_id)->where('indicador_id', $indicador_id)->delete();

		return redirect()->back()->with('message', 'Se agrego el cargo '.$cargo_id.' correctamente.');

    }
}