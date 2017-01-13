<?php

namespace ProyectoKpi\Http\Controllers;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;

use ProyectoKpi\Models\Departamento;
use ProyectoKpi\Models\GrupoDepartamento;
use ProyectoKpi\Http\Requests\DepartamentoFormRequest;
use ProyectoKpi\Http\Requests\DepartamentoRequestUpdate;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;


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
			$grupo = GrupoDepartamento::select('id as idgrupo','nombre as nombregrupo')->where('estado', '=', '1')->get();

			return view('localizaciones.departamento.create',['grupo'=>$grupo]);
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
			$grupo = GrupoDepartamento::select('id as idgrupo','nombre as nombregrupo')->where('estado', '=', '1')->get();

			return view('localizaciones.departamento.edit',['departamento'=>$departamento,'grupo'=>$grupo]);

	}

	public function update(DepartamentoRequestUpdate $Request,$id)
	{
		$result = DB::table('departamentos')->where('nombre', $Request->nombre)->where('id', $id)->count();

		if($result <> 0)
		{
			$departamento = Departamento::findOrFail($id);
			$input = $Request->all();
			$departamento->fill($input)->save();
			return redirect('localizaciones/departamento')->with('message', 'Se modifico correctamente.');
		}else{
			return $this->edit($id)->withErrors('El nombre "'.$Request->nombre.'" ya existe');
		}
	}

	public function show($id)
	{
		$departamento = Departamento::findOrFail($id);
		return response()->json($departamento);
		//return redirect('localizaciones/departamento/delete')->with('departamento', $departamento);


	}

	public  function destroy($id)
	{
			$result = DB::table('departamentos')->where('id', $id)->update(['estado' => 0]);		

			return redirect('localizaciones/departamento')->with('message', 'Se elimino correctamente.');
	}

}
