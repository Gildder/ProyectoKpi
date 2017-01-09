<?php

namespace ProyectoKpi\Http\Controllers;

use ProyectoKpi\Models\GrupoDepartamento;
use ProyectoKpi\Models\Departamento;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Requests\GrupoDepartamentoFormRequest;
use ProyectoKpi\Http\Requests\GrupoDepartamentoRequestUpdate;
use Illuminate\Support\Facades\DB;
use Session;

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

		return redirect('localizaciones/grupodepartamento')->with('message', 'Se guardo correctamente.');
	}

	public function edit($id)
	{
		$grupodepartamento = GrupoDepartamento::findOrFail($id);
		return view('localizaciones.grupodepartamento.edit')->with('grupodepartamento', $grupodepartamento);

	}

	public function update(GrupoDepartamentoRequestUpdate $Request,$id)
	{
		$result = DB::table('grupo_departamentos')->where('nombre', $Request->nombre)->where('id', $id)->count();

		if($result <> 0)
		{
			$grupodepartamento = GrupoDepartamento::findOrFail($id);
			$input = $Request->all();
			$grupodepartamento->fill($input)->save();
			return redirect('localizaciones/grupodepartamento')->with('message', 'Se modifico correctamente.');
		}else{
			return $this->edit($id)->withErrors('El nombre "'.$Request->nombre.'"  ya existe');
		}
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
		
		return redirect('localizaciones/grupodepartamento')->with('message', 'Se elimino correctamente.');


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
