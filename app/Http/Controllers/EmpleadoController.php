<?php

namespace ProyectoKpi\Http\Controllers;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;

use ProyectoKpi\Models\Empleado;


class EmpleadoController extends Controller
{
    //
    public function index()
	{
		$empledos = Empleado::
						select('empledos.codigo','empledos.nombre','empledos.apellidoPaterno','empledos.apellidoMaterno','localizaciones.nombre as localizacion','departamentos.nombre as departamento','departamentos.nombre as departamento','empledos.created_at','empledos.updated_at')->join('localizaciones','localizaciones.id','=','empledos.localizacion_id')
							->join('departamentos','departamentos.id','=','empledos.departamento_id')
							->join('cargos','cargos.id','=','empledos.cargo_id')
							->join('users','users.id','=','empledos.user_id')
						->where('empledos.estado', '=', '1')->get();

		return view('empleados/empleado/index')->with('empledos',$empledos);
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
