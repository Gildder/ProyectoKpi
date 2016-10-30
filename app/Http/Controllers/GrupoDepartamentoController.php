<?php

namespace ProyectoKpi\Http\Controllers;

use ProyectoKpi\Models\GrupoDepartamento;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;

class GrupoDepartamentoController extends Controller
{
    //
      public function index()
	{
		$grdepartamento = GrupoDepartamento::all();
		return view('grupodepartamento/list', compact('grdepartamento'));
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
