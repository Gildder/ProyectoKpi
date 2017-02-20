<?php

namespace ProyectoKpi\Http\Controllers\Supervisores;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


use ProyectoKpi\Http\Controllers\Graficas\GraficasController;
use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\SupervisorEmpleado;

class SupervisadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $user = Auth::user();
        Cache::forever('codigoempleado', $user->empleado->codigo);

        $empleadosDisponibles = DB::select('call pa_supervisores_empleadosSupervisadosEmpleado('.$user->empleado->codigo.');');

        return view('supervisores\supervisados\index', ['empleadosDisponibles'=>$empleadosDisponibles]);
    }

    public function show($id)
    {
        $indicadores = SupervisorEmpleado::getIndicadores($id);
        $graficos =  new GraficasController();
        $datos_graficos = $graficos->getArrayPrimerIndicador($id);

        

        // var_dump($datos_graficos);
        return view('supervisores\supervisados\show', ['indicadores'=>$indicadores, 'grafico' => $graficos->getPrimerIndicador($id), 'datos_graficos'=> $datos_graficos]);
    }

    
}



