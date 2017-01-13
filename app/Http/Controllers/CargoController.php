<?php

namespace ProyectoKpi\Http\Controllers;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Models\Cargo;
use ProyectoKpi\Models\Indicador;
use ProyectoKpi\Http\Requests\CargoFormRequest;
use ProyectoKpi\Http\Requests\CargoRequestUpdate;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

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

		if ($cargo->nombre != '') {
			$cargo->save();
		}else{
			return redirect('empleados/cargo/create')->with('message', 'Se guardo correctamente.');
		}

		return redirect('empleados/cargo')->with('message', 'Se guardo correctamente.');


	}

	public function edit($id)
	{
		$cargo = Cargo::findOrFail($id);
		
		return view('empleados/cargo/edit',['cargo'=>$cargo]);

	}

	public function update(CargoRequestUpdate $Request, $id)
	{

		$result = DB::table('cargos')->where('nombre', $Request->nombre)->where('id', $id)->count();

		if($result <> 0)
		{
			$cargo = Cargo::findOrFail($id);
			$input = $Request->all();
			$cargo->fill($input)->save();

			return redirect('empleados/cargo/show', $id)->with('message', 'Se modifico correctamente.');
		}else{
			return $this->edit($id)->withErrors('El nombre "'.$Request->nombre.'" ya existe');
		}
	}

	public function agregar(Request $Request,$id)
	{
		$cargo = Cargo::findOrFail($id);
    	$nuevos_indicadores = $Request->input('ind',[]);

		for($i = 0; $i < count($nuevos_indicadores); ++$i)
		{
			DB::table('indicadores_cargos')->insert(['indicador_id' => $nuevos_indicadores[$i], 'cargo_id' => $id ]);
    	}

		//return redirect('empleados/cargo/edit')->with('message', 'Se modifico correctamente.');
		//return view('indicadores.indicador');

		$this->edit($id);
	}

	public function show($id)
	{
		$cargo = Cargo::findOrFail($id);
		$indicadores = Cargo::find($id)->indicadores()->where('indicadores_cargos.cargo_id','=',$id)->where('indicadores_cargos.estado','=','1')->get();

		$empleados = DB::table('empleados')
						->join('departamentos', 'departamentos.id', '=', 'empleados.departamento_id')
						->join('localizaciones', 'localizaciones.id', '=', 'empleados.localizacion_id')
						->join('cargos', 'cargos.id', '=', 'empleados.cargo_id')
						->join('users', 'users.id', '=', 'empleados.user_id')
						->select('empleados.codigo','empleados.nombres','empleados.apellidos', 'localizaciones.nombre as localizacion','departamentos.nombre as departamento', 'users.name as usuario','users.email as correo', 'cargos.nombre as cargo')
						->where('empleados.cargo_id', '=', $id)
						->get();


		return view('empleados/cargo/show',['cargo'=>$cargo,'indicadores'=>$indicadores,'empleados'=>$empleados]);
	}

	public function destroy($id)
	{
		$result = DB::table('cargos')
					            ->where('id', $id)
					            ->update(['estado' => 0]);

		return redirect('empleados/cargo')->with('message', 'Se elimino correctamente.');
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