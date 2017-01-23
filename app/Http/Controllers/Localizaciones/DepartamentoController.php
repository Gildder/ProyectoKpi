<?php

namespace ProyectoKpi\Http\Controllers\Localizaciones;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;


use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Models\Localizaciones\GrupoDepartamento;
use ProyectoKpi\Models\Localizaciones\LocalizacionesGrupoDepartamento;
use ProyectoKpi\Http\Requests\Localizaciones\DepartamentoFormRequest;
use ProyectoKpi\Http\Requests\Localizaciones\DepartamentoRequestUpdate;


class DepartamentoController extends Controller
{
    //

    public function index()
	{
			$departamentos = Departamento::
				select('departamentos.id','departamentos.nombre as nombre','grupo_departamentos.nombre as grupo')
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

			return redirect('localizaciones/departamento')->with('message', 'El Departamento "'.$departamento->nombre.'" se guardo correctamente.');
	}

	public function edit($id)
	{
			$departamento = Departamento::findOrFail($id);
			$grupo = GrupoDepartamento::select('id as idgrupo','nombre as nombregrupo')->where('estado', '=', '1')->get();

			return view('localizaciones.departamento.edit',['departamento'=>$departamento,'grupo'=>$grupo]);
	}

	public function update(DepartamentoFormRequest $Request,$id)
	{
		DB::table('departamentos')
            ->where('id', $id)
            ->update(array('nombre' => $Request->nombre, 'grupodep_id'=>$Request->grupodep_id));

		return redirect('localizaciones/departamento')->with('message',  'El Departamento Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function show($id)
	{
		$departamento = Departamento::findOrFail($id);
		return response()->json($departamento);
	}

	public  function destroy($id)
	{
			$result = DB::table('departamentos')->where('id', $id)->update(['estado' => 0]);		

			return redirect('localizaciones/departamento')->with('message', 'El Departamento de Nro.- '.$id.'  se elimino correctamente.');
	}

}
