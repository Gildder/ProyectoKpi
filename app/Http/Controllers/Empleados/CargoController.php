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
use ProyectoKpi\Http\Requests\Empleados\CargoRequestUpdate;

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

		return view('empleados/cargo/index', ['cargos'=> $cargos]);
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

		return redirect('empleados/cargo')->with('message', 'El Cargo "'.$cargo->nombre.'" se guardo correctamente.');
	}


	public function edit($id)
	{
		$cargo = Cargo::findOrFail($id);
		
		return view('empleados/cargo/edit',['cargo'=>$cargo]);

	}

	public function update(CargoFormRequest $Request, $id)
	{
		DB::table('cargos')
            ->where('id', $id)
            ->update(array('nombre' => $Request->nombre));

		return redirect('empleados/cargo')->with('message',  'El Cargo Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function agregar(Request $Request,$id)
	{
		$cargo = Cargo::findOrFail($id);
    	$nuevos_indicadores = $Request->input('ind',[]);

		for($i = 0; $i < count($nuevos_indicadores); ++$i)
		{
			DB::table('indicadores_cargos')->insert(['indicador_id' => $nuevos_indicadores[$i], 'cargo_id' => $id ]);
    	}

		$this->edit($id);
	}

	public function quitar($cargo_id, $ind_id)
	{
		$result = DB::table('indicadores_cargos')
					            ->where('indicador_id', $ind_id)
					            ->where('cargo_id', $cargo_id)
					            ->update(['estado' => 0]);

		return $this->show($cargo_id, 'Elimino');
	}

	public function show($id)
	{
		$cargo = Cargo::findOrFail($id);
		$indicadores = DB::select('call pa_empleados_indicadoresCargos('.$id.')');

				
		return view('empleados/cargo/show',['cargo'=>$cargo,'indicadores'=>$indicadores]);
	}

	public function destroy($id)
	{
		$result = DB::table('cargos')
					            ->where('id', $id)
					            ->update(['estado' => 0]);

		return redirect('empleados/cargo')->with('message',  'El Cargo de Nro.- '.$id.'  se elimino correctamente.');
	}

	public function indicadores($id)
	{
		$cargo = Cargo::find($id);

		//indicadores libres
		$cargos_indicador   = Cargo::find($id)->indicadores()->where('indicadores_cargos.cargo_id','=', $id)->get();
		$todos_indicadores  = Indicador::select('indicadores.*')->where('estado', '=', '1')->get();
		$indicadores_libres = $todos_indicadores->diff($cargos_indicador);	

		//return view('empleados.cargo.edit')->with('cargo', $cargo);
		return view('empleados/cargo/indicadores',['indicadores_libres'=>$indicadores_libres, 'cargo'=> $cargo]);
	}

	public function empleado($id)
	{
		$indicador = Indicador::findOrFail($id);

		return $indicador;
	}


}