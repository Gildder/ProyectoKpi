<?php

namespace ProyectoKpi\Http\Controllers\Tareas;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Models\Localizaciones\Localizacion;


class TareaProgramadaController extends Controller
{
    // protected $tareaProgramadas;
    
    // public function __contruct(CargoRepository $tareaProgramadas)
   	// {
   	// 	//$this->middleware('is_route');
   	// 	$this->tareaProgramadas = $tareaProgramadas;
   	// }


    public function index()
	{	
		$user = Auth::user();  //obtenemos el usuario logueado

		$tareas = Tarea::where('tipo','=', '1')->where('empleado_id', $user->empleado->codigo )->get();

		return view('tareas/tareaProgramadas/index', ['tareas'=> $tareas]);
	}

	public function create()
	{
		$localizaciones = Tarea::getLocalizaciones();

		return view('tareas.tareaProgramadas.create', ['localizaciones'=> $localizaciones]);
	}

	public function store(TareaFormRequest $Request)
	{
		$tareasProgramadas = new Tarea;
		$tareasProgramadas->nombre = trim(\Request::input('nombre'));
		$tareasProgramadas->fechaInicio = trim(\Request::input('fechaInicio'));
		$tareasProgramadas->fechaFin = trim(\Request::input('fechaFin'));
		$tareasProgramadas->save();

		return redirect('tareas/tareaProgramadas')->with('message', 'El tarea "'.$tareasProgramadas->nombre.'" se guardo correctamente.');
	}

	
	public function edit($id)
	{
		$tareasProgramadas = Tarea::findOrFail($id);
		
		return view('tareas/tareasProgramadas/edit',['tarea'=>$tarea]);

	}

	public function update(TareaFormRequest $Request, $id)
	{
		$tareasProgramadas = Tarea::findOrFail($id);
		$tareasProgramadas->nombre = trim(\Request::input('nombre'));
		$tareasProgramadas->fechaInicio = trim(\Request::input('fechaInicio'));
		$tareasProgramadas->fechaFin = trim(\Request::input('fechaFin'));
		$tareasProgramadas->save();

		return redirect('tareas/tareaProgramadas')->with('message',  'El tarea Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function show($id)
	{
		$tareasProgramadas = Tarea::findOrFail($id);
				
		return view('tareas/tareasProgramadas/show',['tarea'=>$tareasProgramadas]);
	}

	public function destroy($id)
	{
		Cargo::destroy($id);

		return redirect('tareas/tareasProgramadas')->with('message',  'El tarea de Nro.- '.$id.'  se elimino correctamente.');
	}
}
