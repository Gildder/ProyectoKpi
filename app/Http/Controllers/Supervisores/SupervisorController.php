<?php

namespace ProyectoKpi\Http\Controllers\Supervisores;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\User;

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
        if ($tipo == 0) { // 0 = cargos, otros = departamentos
            $empleadosDisponibles = DB::select('call pa_supervisores_empleadosDisponiblesCargo('.$id.');');
            $empleadossupervisores = DB::select('call pa_supervisores_empleadosSupervisadoresCargo('.$id.');');
            $lista = Cargo::where('id', '=', $id)->first();
        } else {
            $empleadosDisponibles = DB::select('call pa_supervisores_empleadosDisponiblesDepartamento('.$id.');');
            $empleadossupervisores = DB::select('call pa_supervisores_empleadosSupervisadoresDepartamento('.$id.');');
            $lista = Departamento::where('id', '=', $id)->first();
        }


        return view('supervisores\supervisor\show', ['lista'=>$lista,'empleadosdis'=>$empleadosDisponibles,'empleadosup'=>$empleadossupervisores,'tipo'=>$tipo]);
    }

    public function agregardepartamento($user_id, $departamento_id)
    {
        $empleado = User::where('users.id', $user_id)->first();

        DB::table('supervisor_departamentos')->insert(
            array('user_id' => $user_id, 'departamento_id' => $departamento_id)
        );

        //Actualizacion de Users en campos is_evaluador
        DB::table('users')->where(['id' => $user_id])
            ->update( array('is_supervisor' => 1));

        return redirect()->back()->with('message', 'Se agrego el empleado "'.$empleado->id.' - '.$empleado->name.' '.$empleado->apellidos.'" correctamente.');
    }

    public function quitardepartamento($user_id, $departamento_id)
    {
        $empleado =User::where('users.id', $user_id)->first();

        
        DB::table('supervisor_departamentos')->where('user_id', $user_id)->where('departamento_id', $departamento_id)->delete();

        //Actualizacion de Users en campos is_evaluador
        DB::table('users')->where(['id' => $user_id])
            ->update( array('is_supervisor' => null));

        //Actualizacion de Users en campos is_evaluador
        DB::table('users')->where(['id' => $user_id, 'departamento_id' => $departamento_id])
            ->update( array('is_supervisor' => null));

        return redirect()->back()->with('message', 'Se quito el empleado "'.$empleado->id.' - '.$empleado->name.' '.$empleado->apellidos.'" correctamente.');
    }

    public function agregarcargo($user_id, $cargo_id)
    {
        $empleado =User::where('users.id', $user_id)->first();

        DB::table('supervisor_cargos')->insert(
            array('user_id' => $user_id, 'cargo_id' => $cargo_id)
        );

        //Actualizacion de Users en campos is_evaluador
        DB::table('users')->where(['id' => $user_id])
            ->update( array('is_supervisor' => 1));

        return redirect()->back()->with('message', 'Se agrego el empleado "'.$empleado->id.' - '.$empleado->name.' '.$empleado->apellidos.'" correctamente.');
    }

    public function quitarcargo($empleado_id, $cargo_id)
    {
        $empleado =User::where('users.id', $empleado_id)->first();


        DB::table('supervisor_cargos')->where('user_id', $empleado_id)->where('cargo_id', $cargo_id)->delete();

        //Actualizacion de Users en campos is_evaluador
        DB::table('users')->where(['id' => $empleado_id])
            ->update( array('is_supervisor' => null));

        //Actualizacion de Users en campos is_evaluador
        DB::table('users')->where(['id' => $empleado_id, 'departamento_id' => $cargo_id])
            ->update( array('is_supervisor' => null));

        return redirect()->back()->with('message', 'Se quito el empleado "'.$empleado->id.' - '.$empleado->name.' '.$empleado->apellidos.'" correctamente.');
    }
}
