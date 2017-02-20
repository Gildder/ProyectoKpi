<?php

namespace ProyectoKpi\Http\Controllers\Localizaciones;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent;
use Session;

use ProyectoKpi\Models\Localizaciones\GrupoDepartamento;
use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Http\Requests\Localizaciones\GrupoDepartamentoFormRequest;
use ProyectoKpi\Http\Requests\Localizaciones\GrupoDepartamentoRequestUpdate;

class GrupoDepartamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
	{

		return view('localizaciones/grupodepartamento/index')->with('grupodepartamentos', GrupoDepartamento::all());
	}


	public function create()
	{

		return view('localizaciones.grupodepartamento.create');
	}

	public function store(GrupoDepartamentoFormRequest $Request)
	{
		$grupodepartamento = new GrupoDepartamento;
		$grupodepartamento->nombre = trim(\Request::input('nombre'));
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
		$grupodepartamento = GrupoDepartamento::findOrFail($id);
		$grupodepartamento->nombre = trim(\Request::input('nombre'));
		$grupodepartamento->save();

		return redirect('localizaciones/grupodepartamento')->with('message',  'El Grupo Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function show($id)
	{
		$grupodepartamento = GrupoDepartamento::findOrFail($id);
		return response()->json($grupodepartamento);


	}

	public function destroy($id)
	{
		GrupoDepartamento::destroy($id);	
		
		return redirect('localizaciones/grupodepartamento')->with('message', 'El Grupo de Nro.- '.$id.'  se elimino correctamente.');
	}

	/**
	 * Retorna todos departamentos activos para este grupo
	 */
	public function getDepartamentos(Request $request, $id)
	{
			$departamentos = Departamento::all();

			return $departamentos;
	}

	public function eliminados()
	{
		$grupodepartamentos = GrupoDepartamento::onlyTrashed()->get();
		
		return view('localizaciones/grupodepartamento/eliminados', ['grupodepartamentos'=> $grupodepartamentos]);
	}
	
	function restaurar($id)
	{
		GrupoDepartamento::withTrashed()
        ->where('id', $id)
        ->restore();

		return redirect()->back()->with('message', 'El grupo departamento '.$id.' se restauro correctamente.');
	}
}
