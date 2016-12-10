<?php

namespace ProyectoKpi\Http\Controllers;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;

use ProyectoKpi\Models\Departamento;
use ProyectoKpi\Models\GrupoDepartamento;
use ProyectoKpi\Http\Requests\DepartamentoFormRequest;



class DepartamentoController extends Controller
{
    //

    public function index()
	{
		$departamentos = Departamento::
								select('departamentos.id','departamentos.nombre as departamento','grupo_departamentos.nombre as grupo','departamentos.estado','departamentos.created_at','departamentos.updated_at')
								->join('grupo_departamentos','grupo_departamentos.id','=','departamentos.grupodep_id')
								->where('departamentos.estado', '=', '1')->get();

		return view('localizaciones/departamento/index')->with('departamentos',$departamentos);
	}

	public function create()
	{
		$grupo = GrupoDepartamento::select('id as idgrupo','nombre as nombregrupo')
								->where('estado', '=', '1')->get();

		return view('localizaciones.departamento.create',['grupo'=>$grupo]);
		//return view('localizaciones.departamento.create')->with('grupo',$grupo);
	}

	public function store(DepartamentoFormRequest $Request)
	{
		$departamento = new Departamento;
		$departamento->nombre = $Request->nombre;
		$departamento->grupodep_id = $Request->grupodep_id;
		$departamento->save();

		return redirect('localizaciones/departamento')->with('message', 'Se guardo correctamente.');
	}

	public function edit($id)
	{
		$departamento = Departamento::findOrFail($id);
		$grupo = GrupoDepartamento::select('id as idgrupo','nombre as nombregrupo')
								->where('estado', '=', '1')->get();


		return view('localizaciones.departamento.edit',['departamento'=>$departamento,'grupo'=>$grupo]);

	}

	public function update(DepartamentoFormRequest $Request,$id)
	{
		$departamento = Departamento::findOrFail($id);
		$input = $Request->all();
		$departamento->fill($input)->save();

		//attach roles
    	$user->roles()->sync($request->input('roles',[]));

		return redirect('localizaciones/departamento')->with('message', 'Se modifico correctamente.');

	}

	public function show($id)
	{
		$departamento = Departamento::findOrFail($id);
		return response()->json($departamento);
		//return view('localizaciones/departamento/delete')->with('departamento', $departamento);


	}

	public function destroy($id)
	{


		return redirect('localizaciones/departamento/index')->with('message', 'Se elimino correctamente.');
	}
}
