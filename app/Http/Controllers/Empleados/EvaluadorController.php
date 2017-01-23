<?php

namespace ProyectoKpi\Http\Controllers;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;

use ProyectoKpi\Models\Empleados\Evaluador;


class EvaluadorController extends Controller
{
     /*
    public function __contruct()
   	{
   		$this->middleware('is_route');
   	}*/


    public function index()
	{
		$evaluadores = Evaluador::where('evaluadores.estado', '=', '1')->get();

		return view('empleados/evaluador/index', ['evaluadores'=> $evaluadores]);
	}

	public function create()
	{
		
	}

	public function store(CargoFormRequest $Request)
	{
	}


	public function edit($id)
	{

	}

	public function update(CargoFormRequest $Request, $id)
	{
	}

	public function agregar(Request $Request,$id)
	{
	}

	public function quitar($cargo_id, $ind_id)
	{
	}

	public function show($id)
	{
	}

	public function destroy($id)
	{
	}

	public function indicadores($id)
	{
	}

	public function empleado($id)
	{
	}

}
