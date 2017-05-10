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
use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Models\Empleados\SupervisorEmpleado;
use ProyectoKpi\Cms\Repositories\EficaciaIndicadorRepository;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;
use ProyectoKpi\Http\Requests\Indicadores\ErrorFormRequest;


class SupervisadosController  extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // lista de empleados asignados para su supervison de su usuario
        $empleadosDisponibles = DB::select('call pa_supervisores_empleadosSupervisadosEmpleado('.\Usuario::get('codigo').');');

        return view('supervisores\supervisados\index', ['empleadosDisponibles'=>$empleadosDisponibles]);
    }

    public function show($empleado_id)
    {
        // Lista de indicadores supervisados a un empleado supervisado
        $indicadores = IndicadorRepository::cnGetListaInidicadores($empleado_id);
        // informacion del empleado supervisado
        $empleado = Empleado::where('codigo', $empleado_id)->first();

        return view('supervisores\supervisados\show', ['indicadores'=>$indicadores, 'empleado'=>$empleado]);
    }

    // tareas finalizadas estado = 3 isError = 0
    public function obtenerTareasFinalizadas($anio, $mes, $semana, $empleado_id)
    {
        // obtener las tareas finalizadas con los parametros enviados, mas los tareas que estan marcadas con errores de manera desabilitada
        // pero espeficicando que ya esta agregada con error 
        $tareas = DB::select("call pa_eficiencia_tareasTerminadas(".$anio.", ".$mes.", ".$semana.", '".$empleado_id."',0);");

        return view('supervisores\numeroErrores\create',['tareas'=> $tareas, 'empleado_id'=>$empleado_id]);
    }

    // tareas finalizadas estado  = 3 isError = 1
    public function obtenerTareasErrores($anio, $mes, $semana, $empleado_id)
    {
        // obtener las tareas finalizadas con los parametros enviados, mas los tareas que estan marcadas con errores de manera desabilitada
        // pero espeficicando que ya esta agregada con error 
        $tareas = DB::select("call pa_eficiencia_tareasTerminadas(".$anio.", ".$mes.", ".$semana.", '".$empleado_id."', 1);");

        return view('supervisores\numeroErrores\delete',['tareas'=> $tareas, 'empleado_id'=>$empleado_id]);
    }

    public function agregarErrorTarea(ErrorFormRequest $Request, $empleado_id)
    {

        $tarea_id = \Request::input('tarea_id');
        $descripcion = trim(\Request::input('descripcion'));

        // dd($tarea_id, $descripcion);

        $tarea = Tarea::findOrFail($tarea_id);
        $tarea->isError = 1;
        $tarea->save();

        $nota_id = DB::table('nota_errores')->insertGetId([
            'descripcion'=> $descripcion,
            'tarea_id'=> $tarea_id,
            'razonNota'=> 1,
            'supervisor_id'=> $empleado_id,
        ]);
        
        
        DB::select("call pa_eficiencia_actualizarNroErrores('".$tarea->fechaFinSolucion."', '".$empleado_id."', 1);");
        return redirect()->back()->with('El numero de Errores se aumento correctamente.');
    }

    public function quitarErrorTarea(ErrorFormRequest $Request, $empleado_id)
    {
        $tarea_id = \Request::input('tarea_id');
        $descripcion = trim(\Request::input('descripcion'));

        // dd($tarea_id, $descripcion);

        $tarea = Tarea::findOrFail($tarea_id);
        $tarea->isError = 0;
        $tarea->save();

        $nota_id = DB::table('nota_errores')->insertGetId([
            'descripcion'=> $descripcion,
            'tarea_id'=> $tarea_id,
            'razonNota'=> 0,
            'supervisor_id'=> $empleado_id,
        ]);
        
        
        DB::select("call pa_eficiencia_actualizarNroErrores('".$tarea->fechaFinSolucion."', '".$empleado_id."', 0);");
        return redirect()->back()->with('El numero de Errores se aumento correctamente.');
    }
    
}



