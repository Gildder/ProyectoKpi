<?php

namespace ProyectoKpi\Http\Controllers\Tareas;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;

use ProyectoKpi\Models\Tareas\Proyecto;
use ProyectoKpi\Http\Requests\Tareas\ProyectoFormRequest;


class ProyectoController extends Controller
{
    protected $proyectos;
    
    public function __contruct(CargoRepository $proyectos)
   	{
   		//$this->middleware('is_route');
   		$this->proyectos = $proyectos;
   	}


    public function index()
	{
		return view('tareas/proyecto/index', ['proyectos'=> Proyecto::all()]);
	}

	public function create()
	{

		return view('tareas.proyecto.create');
	}

	public function store(ProyectoFormRequest $Request)
	{
		$proyecto = new Proyecto;
		$proyecto->nombre = trim(\Request::input('nombre'));
		$proyecto->fechaInicio = trim(\Request::input('fechaInicio'));
		$proyecto->fechaFin = trim(\Request::input('fechaFin'));
		$proyecto->save();

		return redirect('tareas/proyecto')->with('message', 'El proyecto "'.$proyecto->nombre.'" se guardo correctamente.');
	}

	
	public function edit($id)
	{
		$proyecto = Proyecto::findOrFail($id);
		
		return view('tareas/proyecto/edit',['proyecto'=>$proyecto]);

	}

	public function update(ProyectoFormRequest $Request, $id)
	{
		$proyecto = Proyecto::findOrFail($id);
		$proyecto->nombre = trim(\Request::input('nombre'));
		$proyecto->fechaInicio = trim(\Request::input('fechaInicio'));
		$proyecto->fechaFin = trim(\Request::input('fechaFin'));
		$proyecto->save();

		return redirect('tareas/proyecto')->with('message',  'El Proyecto Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function show($id)
	{
		$proyecto = Proyecto::findOrFail($id);
				
		return view('tareas/proyecto/show',['proyecto'=>$proyecto]);
	}

	public function destroy($id)
	{
		Cargo::destroy($id);

		return redirect('tareas/proyecto')->with('message',  'El Proyecto de Nro.- '.$id.'  se elimino correctamente.');
	}
}
