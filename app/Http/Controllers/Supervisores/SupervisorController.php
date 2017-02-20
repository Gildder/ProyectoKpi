<?php

namespace ProyectoKpi\Http\Controllers\Supervisores;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Models\Empleados\Empleado;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
    	$departamentos = Departamento::select('departamentos.*')->get();

        return view('supervisores\supervisor\index', ['departamentos'=>$departamentos]);
    }

    public function show($id)
    {
        $empleadosDisponibles = DB::select('call pa_supervisores_empleadosDisponiblesDepartamento('.$id.');');
        $empleadossupervisores = DB::select('call pa_supervisores_empleadosSupervisadoresDepartamento('.$id.');');

        $departamento = Departamento::where('id','=',$id)->first();

        return view('supervisores\supervisor\show', ['departamento'=>$departamento,'empleadosdis'=>$empleadosDisponibles,'empleadosup'=>$empleadossupervisores]);
    }

    public function agregardepartamento($emp_id, $dep_id)
    {
        DB::table('supervisor_departamentos')->insert(
            array('empleado_id' => $emp_id, 'departamento_id' => $dep_id)
        );

        return redirect()->back()->with('message', 'Se agrego el empleado: '.$emp_id. ' correctamente.');
    }

    public function quitardepartamento($emp_id, $dep_id)
    {
        DB::table('supervisor_departamentos')->where('empleado_id', $emp_id)->where('departamento_id', $dep_id)->delete();


        return redirect()->back()->with('message', 'Se quito el empleado: '.$emp_id. ' correctamente.');

    }

    // Lista de empleados asignados aa un supervisor
    public function supervisados($emp_id)
    {
        $empleados = DB::select('call pa_supervisores_empleadosSupervisadosEmpleado('.$emp_id.')');

        return view('supervisores/indicadores/index')->with('empleados',$empleados);
    }
}
