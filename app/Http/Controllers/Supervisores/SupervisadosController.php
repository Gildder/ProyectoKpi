<?php

namespace ProyectoKpi\Http\Controllers\Supervisores;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Khill\Lavacharts\Laravel\Lavacharts;


use ProyectoKpi\Http\Controllers\Graficas\GraficasController;
use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\SupervisorEmpleado;
use ProyectoKpi\Cms\Repositories\PrimerIndicadorRepository;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;

class SupervisadosController  extends Controller
{
    protected $primerIndicador;

    public function __construct(PrimerIndicadorRepository $primerIndicador)
    {
        $this->middleware('auth');
        $this->primerIndicador = $primerIndicador;

    }

    
    public function index()
    {
        $user = Auth::user();
        Cache::forever('codigoempleado', $user->empleado->codigo);

        // lista de empleados asignados para su supervison de su usuario
        $empleadosDisponibles = DB::select('call pa_supervisores_empleadosSupervisadosEmpleado('.$user->empleado->codigo.');');

        
        return view('supervisores\supervisados\index', ['empleadosDisponibles'=>$empleadosDisponibles]);
    }

    public function show($id)
    {
        $indicadores = IndicadorRepository::getIndicadoresEmpleado($id);
        $empleado = Empleado::where('codigo', $id)->first();
        // $listaTablas;
        // $listaGraficas;
        // $contador = 0;


        // foreach ($indicadores as $item) {
        //     $listaTablas[$contador] = IndicadorRepository::getTablaIndicador($id, $item->id);
        //     $listaGraficas[$contador] = IndicadorRepository::getGraficoIndicador($id, $item->id);
        //     $contador++;
        // }

// print_r(json_encode($listaGraficas));
// // print_r($listaTablas);

//         foreach ($indicadores as $key) {
//             $index = 0;
//             foreach ($listaGraficas as $item) {
//                 if ($key->id  == $item[$index]->indicador_id) {
//                 # code...
//                     print_r($item);
//                     print_r(json_encode($item[0]->empleado_id));
//                 }else{
//                     print_r('error');
//                 }
//                 $index++;
//                 // print_r(json_encode($key->id));
//             }
//         }

        return view('supervisores\supervisados\show', ['indicadores'=>$indicadores, 'empleado'=>$empleado]);
    }


    
    
}



