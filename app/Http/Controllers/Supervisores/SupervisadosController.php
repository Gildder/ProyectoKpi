<?php

namespace ProyectoKpi\Http\Controllers\Supervisores;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use ProyectoKpi\Http\Controllers\Graficas\GraficoController;
use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\SupervisorEmpleado;

class SupervisadosController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $empleadosDisponibles = DB::select('call pa_supervisores_empleadosSupervisadosEmpleado('.$user->empleado->codigo.');');

        return view('supervisores\supervisados\index', ['empleadosDisponibles'=>$empleadosDisponibles]);
    }

    public function show($id)
    {
        $indicadores = SupervisorEmpleado::getIndicadores($id);
        $grafico =  new GraficoController();

        return view('supervisores\supervisados\show', ['indicadores'=>$indicadores, 'grafico' => $grafico->getPrimerIndicador($id)]);
    }

    
}



