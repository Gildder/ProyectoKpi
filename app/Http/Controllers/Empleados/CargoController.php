<?php

namespace ProyectoKpi\Http\Controllers\Empleados;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Http\Requests;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Http\Requests\Empleados\CargoFormRequest;

use ProyectoKpi\Repositories\CargoRepository;

class CargoController extends Controller
{
    
    public function __contruct()
   	{
   		$this->middleware('auth');
   	}


    public function index()
	{
		return view('empleados/cargo/index', ['cargos'=> Cargo::all()]);
	}

	public function eliminados()
	{
		$cargos = Cargo::onlyTrashed()->get();
		
		return view('empleados/cargo/eliminados', ['cargos'=> $cargos]);
	}

	public function create()
	{

		return view('empleados.cargo.create');
	}

	function restaurar($id)
	{
		// $cargo = Tarea::findOrFail('id', $id);
		$cargo = Cargo::withTrashed()
        ->where('id', $id)
        ->restore();

		return $this->index();
	}

	public function store(CargoFormRequest $Request)
	{
		$cargo = new Cargo;
		$cargo->nombre = trim(\Request::input('nombre'));
		$cargo->save();

		return redirect('empleados/cargo')->with('message', 'El Cargo "'.$cargo->nombre.'" se guardo correctamente.');
	}

	
	public function edit($id)
	{
		$cargo = Cargo::findOrFail($id);
		
		return view('empleados/cargo/edit',['cargo'=>$cargo]);

	}

	public function update(CargoFormRequest $Request, $id)
	{
		$cargo = Cargo::findOrFail($id);
		$cargo->nombre = trim(\Request::input('nombre'));
		$cargo->save();

		return redirect('empleados/cargo')->with('message',  'El Cargo Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function show($id)
	{
		$cargo = Cargo::findOrFail($id);
				
		return view('empleados/cargo/show',['cargo'=>$cargo]);
	}

	public function destroy($id)
	{
		Cargo::destroy($id);

		return redirect('empleados/cargo')->with('message',  'El Cargo de Nro.- '.$id.'  se elimino correctamente.');
	}

}