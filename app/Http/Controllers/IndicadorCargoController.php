<?php

namespace ProyectoKpi\Http\Controllers;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;

class IndicadorCargoController extends Controller
{
    //
    public function index()
	{
		return "metodo index";
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
