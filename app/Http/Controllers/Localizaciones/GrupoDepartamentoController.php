<?php

namespace ProyectoKpi\Http\Controllers\Localizaciones;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;

use ProyectoKpi\Models\Localizaciones\GrupoDepartamento;
use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Http\Requests\Localizaciones\GrupoDepartamentoFormRequest;
use ProyectoKpi\Http\Requests\Localizaciones\GrupoDepartamentoRequestUpdate;

class GrupoDepartamentoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function todosDepartamntos($id)
    {
		return  Departamento::where('estado', '=', '1')->where('grupodep_id','=', $id)->get();
    	
    }
    
    public function index()
	{
		$grupodepartamentos = GrupoDepartamento::where('grupo_departamentos.estado', '=', '1')->get();

		return view('localizaciones/grupodepartamento/index')->with('grupodepartamentos', $grupodepartamentos);
	}


	public function create()
	{

		return view('localizaciones.grupodepartamento.create');
	}

	public function store(GrupoDepartamentoFormRequest $Request)
	{
		$grupodepartamento = new GrupoDepartamento;
		$grupodepartamento->nombre = \Request::input('nombre');

		
		$grupodepartamento->save();

		return redirect('localizaciones/grupodepartamento')->with('message', 'El Grupo "'.$grupodepartamento->nombre.'" se guardo correctamente.');
	}

	public function edit($id)
	{
		$grupodepartamento = GrupoDepartamento::findOrFail($id);
		return view('localizaciones.grupodepartamento.edit')->with('grupodepartamento', $grupodepartamento);

	}

	public function update(GrupoDepartamentoFormRequest $Request,$id)
	{
		DB::table('grupo_departamentos')
            ->where('id', $id)
            ->update(array('nombre' => $Request->nombre));

		return redirect('localizaciones/grupodepartamento')->with('message',  'El Grupo Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function show($id)
	{
		$grupodepartamento = GrupoDepartamento::findOrFail($id);
		return response()->json($grupodepartamento);


	}

	public function destroy($id)
	{
		$result = DB::table('grupo_departamentos')
					            ->where('id', $id)
					            ->update(['estado' => 0]);		
		
		return redirect('localizaciones/grupodepartamento')->with('message', 'El Grupo de Nro.- '.$id.'  se elimino correctamente.');
	}

	/**
	 * Retorna todos departamentos activos para este grupo
	 */
	public function getDepartamentos(Request $request, $id)
	{
			$departamentos = Departamento::obtenerDepartamento($id);

			return $departamentos;
	}
}
