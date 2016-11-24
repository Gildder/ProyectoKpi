<?php

namespace ProyectoKpi\Http\Controllers;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Models\Cargo;
use Illuminate\Support\Facades\Redirect;
use ProyectoKpi\Http\Requests\CargoFormRequest;
use Illuminate\Database\Query\Builder;
use DB;

class CargoController extends Controller
{
    /*
    public function __contruct()
   	{
   		$this->middleware('is_route');
   	}*/


    public function index()
	{
		$cargos = Cargo::where('cargos.estado', '=', '1')->get();

		return view('empleados/cargo/index')->with('cargos', $cargos);
	}

	public function create()
	{

		return view('empleados.cargo.create');
	}

	public function store(CargoFormRequest $Request)
	{
		$cargo = new Cargo;
		$cargo->nombre = \Request::input('nombre');
		$cargo->save();

		return redirect('empleados/cargo')->with('message', 'Se guardo correctamente.');


	}

	public function edit($id)
	{
		$cargo = Cargo::findOrFail($id);
		return view('empleados.cargo.edit')->with('cargo', $cargo);

	}

	public function update(CargoFormRequest $Request,$id)
	{
		$cargo = Cargo::findOrFail($id);
		$input = $Request->all();
		$cargo->fill($input)->save();

		return redirect('empleados/cargo')->with('message', 'Se modifico correctamente.');

	}

	public function show($id)
	{
		$cargo = Cargo::findOrFail($id);
		return response()->json($cargo);
		//return view('empleados/cargo/delete')->with('cargo', $cargo);


	}

	public function destroy($id)
	{
		$result = DB::table('grupo_departamentos')
					            ->where('id', $id)
					            ->update(['estado' => 0]);

		return redirect('empleados/cargo/index')->with('message', 'Se elimino correctamente.');
	}
}