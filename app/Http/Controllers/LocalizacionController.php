<?php

namespace ProyectoKpi\Http\Controllers;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;

use ProyectoKpi\Models\Localizacion;
use ProyectoKpi\Models\GrupoLocalizacion;
use ProyectoKpi\Http\Requests\LocalizacionFormRequest;
use ProyectoKpi\Http\Requests\LocalizacionRequestUpdate;
use Illuminate\Support\Facades\DB;


class LocalizacionController extends Controller
{
    //
    public function index()
	{
		$localizaciones = Localizacion::
								select('localizaciones.id','localizaciones.nombre as localizacion','grupo_localizaciones.nombre as grupo','localizaciones.estado','localizaciones.created_at','localizaciones.updated_at')->join('grupo_localizaciones','grupo_localizaciones.id','=','localizaciones.grupoloc_id')
								->where('localizaciones.estado', '=', '1')->get();

		return view('localizaciones/localizacion/index')->with('localizaciones',$localizaciones);
	}


	public function create()
	{
		$grupo = GrupoLocalizacion::select('id as idgrupo','nombre as nombregrupo')
								->where('estado', '=', '1')->get();

		return view('localizaciones.localizacion.create',['grupo'=>$grupo]);
		//return view('localizaciones.departamento.create')->with('grupo',$grupo);
	}

	public function store(LocalizacionFormRequest $Request)
	{
		$localizacion = new Localizacion;
		$localizacion->nombre = $Request->nombre;
		$localizacion->grupoloc_id = $Request->grupoloc_id;
		$localizacion->save();

		return redirect('localizaciones/localizacion')->with('message', 'Se guardo correctamente.');
	}

	public function edit($id)
	{
		$localizacion = Localizacion::findOrFail($id);
		$grupo = GrupoLocalizacion::select('id as idgrupo','nombre as nombregrupo')->where('estado', '=', '1')->get();


		return view('localizaciones.localizacion.edit',['localizacion'=>$localizacion,'grupo'=>$grupo]);

	}

	public function update(localizacionRequestUpdate $Request,$id)
	{

		$result = DB::table('localizaciones')->where('nombre', $Request->nombre)->where('id', $id)->count();

		if($result <> 0)
		{
			$localizacion = Localizacion::findOrFail($id);
			$input = $Request->all();
			$localizacion->fill($input)->save();
			return redirect('localizaciones/localizacion')->with('message', 'Se modifico correctamente.');
		}else{
			return $this->edit($id)->withErrors('El nombre "'.$Request->nombre.'" ya existe');
		}

	}

	public function show($id)
	{
		$localizacion = Localizacion::findOrFail($id);
		return response()->json($localizacion);
		//return view('localizaciones/departamento/delete')->with('departamento', $departamento);


	}

	public  function destroy($id)
	{
		$result = DB::table('localizaciones')
					            ->where('id', $id)
					            ->update(['estado' => 0]);		

		return redirect('localizaciones/localizacion')->with('message', 'Se elimino correctamente.');
	}
}
