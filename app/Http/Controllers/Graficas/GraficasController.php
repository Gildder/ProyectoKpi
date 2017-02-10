<?php

namespace ProyectoKpi\Http\Controllers\Graficas;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;


use ProyectoKpi\Models\Indicadores\PrimerIndicador;
use ProyectoKpi\Models\Grafico\Grafico;
use  khill\lavacharts\lavacharts;

class GraficasController extends Controller
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

	public function getArrayPrimerIndicador($emp_id)
	{
		$indicador = DB::select('call pa_supervisores_primerIndicador('.$emp_id.');');

		$datos = Array([],[]);
		// $datos[0][0] = 'Mes';
		// $datos[0][1] = 'Semama_1';
		// $datos[0][2] = 'Semama_2';
		// $datos[0][3] = 'Semama_3';
		// $datos[0][4] = 'Semama_4';

		$grafico = new Grafico;

		foreach ($indicador as $item) {
			$datos[$item->mes - 1][0] = $this->getNombreMes($item->mes);
			$datos[$item->mes - 1][$item->semana ] = $item->efeser;
		}

		print_r((object)$datos);
		return (object)$datos;
	}

	
	public function getNombreMes($num_mes)
	{
		switch ($num_mes) {
				case '1':
					return 'Enero';
					break;
				case '2':
					return 'Febrero';
					break;
				case '3':
					return 'Marzo';
					break;
				case '4':
					return 'Abril';
					break;
				case '5':
					return 'Mayo';
					break;
				case '6':
					return 'Junio';
					break;
				case '7':
					return 'Julio';
					break;
				case '8':
					return 'Agosto';
					break;
				case '9':
					return 'Septiembre';
					break;
				case '10':
					return 'Octubre';
					break;
				case '11':
					return 'Noviembre';
					break;
				default:
					return 'Diciembre';
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
