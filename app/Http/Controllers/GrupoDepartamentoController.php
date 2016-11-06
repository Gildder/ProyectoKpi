<?php

namespace ProyectoKpi\Http\Controllers;

use ProyectoKpi\Models\GrupoDepartamento;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;

class GrupoDepartamentoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest');
    }

    
      public function index()
	{
		$grdepartamentos = \App\Models\GrupoDepartamento::select('grdepartamentos.id','grdepartamentos.nombre','grdepartamentos.estado')->get();
		return view('grupodepartamento/list')->with('grdepartamentos', $grdepartamentos);
	}


	public function create()
	{
		return view('grupodepartamento.create');
	}

	public function store(Request $Request)
	{
		\ProyectoKpi\Models\GrupoDepartamento::create([
			'nombre'=>$Request['nombre'],
		]);

		return 'Grupo registrado';

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
