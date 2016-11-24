<?php

namespace ProyectoKpi\Http\Controllers;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Models\Localizacion;

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
		return "metodo create";
	}

	public function store()
	{
		return "metodo store";

	}

	public function show($id)
	{
		return "metodo show ".$id;

	}

	public function update($id)
	{
		return "metodo update ".$id;

	}

	public function destroy($id)
	{
		return "metodo destroy ".$id;

	}
}
