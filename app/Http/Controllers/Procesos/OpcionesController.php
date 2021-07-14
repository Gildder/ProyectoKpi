<?php

namespace ProyectoKpi\Http\Controllers\Procesos;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Models\Procesos\OpcionAprobacion;

class OpcionesController extends Controller
{
    public function index()
    {
    	$opciones = OpcionAprobacion::all();

    	return view('procesos.opciones.index')->with('opciones', $opciones);
    }
}
