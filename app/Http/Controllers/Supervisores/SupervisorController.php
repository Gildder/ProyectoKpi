<?php

namespace ProyectoKpi\Http\Controllers\Supervisores;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\Cargo;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $departamentos = Departamento::select('departamentos.*')->get();
    	$cargos = Cargo::select('cargos.*')->get();

        return view('supervisores\supervisor\index', ['departamentos'=>$departamentos, 'cargos'=>$cargos]);
    }

    public function show($id, $tipo)
    {
        if ($tipo == 0) // 0 = cargos, otros = departamentos
        {
            $empleadosDisponibles = DB::select('call pa_supervisores_empleadosDisponiblesCargo('.$id.');');
            $empleadossupervisores = DB::select('call pa_supervisores_empleadosSupervisadoresCargo('.$id.');');
            $lista = Cargo::where('id','=',$id)->first();
        }else{
            $empleadosDisponibles = DB::select('call pa_supervisores_empleadosDisponiblesDepartamento('.$id.');');
            $empleadossupervisores = DB::select('call pa_supervisores_empleadosSupervisadoresDepartamento('.$id.');');
            $lista = Departamento::where('id','=',$id)->first();
        }


        return view('supervisores\supervisor\show', ['lista'=>$lista,'empleadosdis'=>$empleadosDisponibles,'empleadosup'=>$empleadossupervisores,'tipo'=>$tipo]);
    }

    public function agregardepartamento($empleado_id, $departamento_id)
    {
        $empleado =Empleado::where('empleados.codigo', $empleado_id)->first();

        DB::table('supervisor_departamentos')->insert(
            array('empleado_id' => $empleado_id, 'departamento_id' => $departamento_id)
        );

        return redirect()->back()->with('message', 'Se agrego el empleado "'.$empleado->codigo.' - '.$empleado->nombres.' '.$empleado->apellidos.'" correctamente.');
    }

    public function quitardepartamento($empleado_id, $departamento_id)
    {
        $empleado =Empleado::where('empleados.codigo', $empleado_id)->first();

        
        DB::table('supervisor_departamentos')->where('empleado_id', $empleado_id)->where('departamento_id', $departamento_id)->delete();


        return redirect()->back()->with('message', 'Se quito el empleado "'.$empleado->codigo.' - '.$empleado->nombres.' '.$empleado->apellidos.'" correctamente.');
    }

    public function agregarcargo($empleado_id, $cargo_id)
    {
        $empleado =Empleado::where('empleados.codigo', $empleado_id)->first();


        DB::table('supervisor_cargos')->insert(
            array('empleado_id' => $empleado_id, 'cargo_id' => $cargo_id)
        );

        return redirect()->back()->with('message', 'Se agrego el empleado "'.$empleado->codigo.' - '.$empleado->nombres.' '.$empleado->apellidos.'" correctamente.');
    }

    public function quitarcargo($empleado_id, $cargo_id)
    {
        $empleado =Empleado::where('empleados.codigo', $empleado_id)->first();


        DB::table('supervisor_cargos')->where('empleado_id', $empleado_id)->where('cargo_id', $cargo_id)->delete();


        return redirect()->back()->with('message', 'Se quito el empleado "'.$empleado->codigo.' - '.$empleado->nombres.' '.$empleado->apellidos.'" correctamente.');
    }

}
