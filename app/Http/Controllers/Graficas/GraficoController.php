<?php

namespace ProyectoKpi\Http\Controllers\Graficas;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;


use ProyectoKpi\Models\Indicadores\PrimerIndicador;


class GraficoController extends Controller
{
    
    public function __contruct()
   	{
   	}


    public function index()
	{	
		// $departamentos = DB::select('call pa_supervisores_primerIndicador('..');');

		return view('localizaciones/departamento/index');//->with('departamentos', $departamentos );
	}


    public static function getPrimerIndicador($emp_id)
	{	
		$indicador = DB::select('call pa_supervisores_primerIndicador('.$emp_id.');');

		return $indicador;
	}

	public function getBadge($semana)
	{

		switch ($semana) {
			case '1':
				return 'bg-light-blue';
				break;
			case '2':
				return 'bg-red';
				break;
			case '3':
				return 'bg-yellow';
				break;
			default:
				return 'bg-green';
				break;
		}
	}

	public function create()
	{
		return view('localizaciones.departamento.create',['grupo'=> GrupoDepartamento::all()]);
	}

	public function store(DepartamentoFormRequest $Request)
	{
		$departamento = new Departamento;
		$departamento->nombre = trim(\Request::input('nombre'));
		$departamento->grupodep_id = $Request->grupodep_id;
		$departamento->save();

		return redirect('localizaciones/departamento')->with('message', 'El Departamento "'.$departamento->nombre.'" se guardo correctamente.');
	}

	public function edit($id)
	{
		$departamento = Departamento::findOrFail($id);
		$grupo = GrupoDepartamento::all();

		return view('localizaciones.departamento.edit',['departamento'=>$departamento,'grupo'=>$grupo]);
	}

	public function update(DepartamentoFormRequest $Request,$id)
	{
		$departamento = Departamento::findOrFail($id);
		$departamento->nombre = trim(\Request::input('nombre'));
		$departamento->grupodep_id = $Request->grupodep_id;
		$departamento->save();

		return redirect('localizaciones/departamento')->with('message',  'El Departamento Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function show($id)
	{
		$departamento = Departamento::findOrFail($id);
		return response()->json($departamento);
	}

	public  function destroy($id)
	{
		Departamento::destroy($id);		

		return redirect('localizaciones/departamento')->with('message', 'El Departamento de Nro.- '.$id.'  se elimino correctamente.');
	}

}
