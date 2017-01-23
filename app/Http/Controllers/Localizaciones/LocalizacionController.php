<?php

namespace ProyectoKpi\Http\Controllers\Localizaciones;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use ProyectoKpi\Models\Localizaciones\GrupoLocalizacion;
use ProyectoKpi\Models\Localizaciones\Localizacion;
use ProyectoKpi\Http\Requests\Localizaciones\LocalizacionFormRequest;
use ProyectoKpi\Http\Requests\Localizaciones\LocalizacionRequestUpdate;


class LocalizacionController extends Controller
{
    //
    public function index()
	{
		$localizaciones = Localizacion::
								select('localizaciones.id','localizaciones.nombre','localizaciones.direccion','localizaciones.telefono','grupo_localizaciones.nombre as grupo')->join('grupo_localizaciones','grupo_localizaciones.id','=','localizaciones.grupoloc_id')
								->where('localizaciones.estado', '=', '1')->get();

		return view('localizaciones/localizacion/index')->with('localizaciones',$localizaciones);
	}


	public function create()
	{
		$grupo = GrupoLocalizacion::select('id as idgrupo','nombre as nombregrupo')
								->where('estado', '=', '1')->get();

		return view('localizaciones.localizacion.create',['grupo'=>$grupo]);
	}

	public function store(LocalizacionFormRequest $Request)
	{
		$localizacion = new Localizacion;
		$localizacion->nombre = $Request->nombre;
		$localizacion->direccion = $Request->direccion;
		$localizacion->telefono = $Request->telefono;
		$localizacion->grupoloc_id = $Request->grupoloc_id;
		$localizacion->save();

		return redirect('localizaciones/localizacion')->with('message',  'La Localizacion "'.$localizacion->nombre.'" se guardo correctamente.');
	}

	public function edit($id)
	{
		$localizacion = Localizacion::findOrFail($id);
		$grupo = GrupoLocalizacion::select('id as idgrupo','nombre as nombregrupo')->where('estado', '=', '1')->get();


		return view('localizaciones.localizacion.edit',['localizacion'=>$localizacion,'grupo'=>$grupo]);

	}

	public function update(LocalizacionFormRequest $Request,$id)
	{

		DB::table('localizaciones')
            ->where('id', $id)
            ->update(array('nombre' => $Request->nombre,'direccion' => $Request->direccion,'telefono' => $Request->telefono, 'grupoloc_id'=>$Request->grupoloc_id));

		return redirect('localizaciones/localizacion')->with('message',  'La Localizacion Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
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

		return redirect('localizaciones/localizacion')->with('message', 'La Localizacion de Nro.- '.$id.'  se elimino correctamente.');
	}
}
