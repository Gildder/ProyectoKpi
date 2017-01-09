<?php

namespace ProyectoKpi\Http\Controllers;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;

use ProyectoKpi\Models\GrupoLocalizacion;
use ProyectoKpi\Http\Requests\GrupoLocalizacionFormRequest;
use ProyectoKpi\Http\Requests\GrupoLocalizacionRequestUpdate;
use Illuminate\Support\Facades\DB;



class GrupoLocalizacionController extends Controller
{
	public function __construct()
    {
        //$this->middleware('guest');
    }
    
    public function index()
	{
		$grupolocalizaciones = GrupoLocalizacion::where('grupo_localizaciones.estado', '=', '1')->get();

		return view('localizaciones/grupolocalizacion/index')->with('grupolocalizaciones', $grupolocalizaciones);
	}

	public function create()
	{

		return view('localizaciones.grupolocalizacion.create');
	}

	public function store(GrupoLocalizacionFormRequest $Request)
	{
		$grupolocalizacion = new GrupoLocalizacion;
		$grupolocalizacion->nombre = \Request::input('nombre');
		$grupolocalizacion->save();

		return redirect('localizaciones/grupolocalizacion')->with('message', 'Se guardo correctamente.');


	}

	public function edit($id)
	{
		$grupolocalizacion = GrupoLocalizacion::findOrFail($id);
		return view('localizaciones.grupolocalizacion.edit')->with('grupolocalizacion', $grupolocalizacion);

	}

	public function update(GrupoLocalizacionRequestUpdate $Request,$id)
	{
		$grupolocalizacion = GrupoLocalizacion::findOrFail($id);
		$input = $Request->all();
		$grupolocalizacion->fill($input)->save();

		return redirect('localizaciones/grupolocalizacion')->with('message', 'Se modifico correctamente.');


		$result = DB::table('grupo_localizaciones')->where('nombre', $Request->nombre)->where('id', $id)->count();

		if($result <> 0)
		{
			$grupolocalizacion = GrupoLocalizacion::findOrFail($id);
			$input = $Request->all();
			$grupolocalizacion->fill($input)->save();
			return redirect('localizaciones/grupolocalizacion')->with('message', 'Se modifico correctamente.');
		}else{
			return $this->edit($id)->withErrors('El nombre "'.$Request->nombre.'" ya existe');
		}
	}

	public function show($id)
	{
		$grupolocalizacion = GrupoLocalizacion::findOrFail($id);
		return response()->json($grupolocalizacion);
		//return view('localizaciones/grupolocalizacion/delete')->with('grupolocalizacion', $grupolocalizacion);


	}

	public function destroy($id)
	{
		$result = DB::table('grupo_localizaciones')
					            ->where('id', $id)
					            ->update(['estado' => 0]);

		return redirect('localizaciones/grupolocalizacion')->with('message', 'Se elimino correctamente.');
	}
}