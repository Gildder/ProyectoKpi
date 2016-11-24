<?php

namespace ProyectoKpi\Http\Controllers;

use ProyectoKpi\Models\GrupoDepartamento;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Requests\GrupoDepartamentoFormRequest;

use Session;

class GrupoDepartamentoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest');
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

	public function update(GrupoDepartamentoFormRequest $Request,$id)
	{
		$grupodepartamento = GrupoDepartamento::findOrFail($id);
		$input = $Request->all();
		$grupodepartamento->fill($input)->save();

		return redirect('localizaciones/grupodepartamento')->with('message', 'Se modifico correctamente.');

	}

	public function show($id)
	{
		$grupodepartamento = GrupoDepartamento::findOrFail($id);
		return response()->json($grupodepartamento);
		//return view('localizaciones/grupodepartamento/delete')->with('grupodepartamento', $grupodepartamento);


	}

	public function destroy($id)
	{
		$result = DB::table('grupo_departamentos')
					            ->where('id', $id)
					            ->update(['estado' => 0]);

		return redirect('localizaciones/grupodepartamento/index')->with('message', 'Se elimino correctamente.');
	}
}
