<?php

namespace ProyectoKpi\Http\Controllers\Indicadores;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Http\Requests;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Models\Indicadores\Variable;
use ProyectoKpi\Http\Requests\Indicadores\VariableFormRequest;
use ProyectoKpi\Http\Models\Indicadores\VariableIndicador;

class VariableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $variables = Variable::all();

        return view('indicadores/variable/index', ['variables'=> $variables]);
    }

    public function create()
    {
        return view('indicadores/variable/create');
    }

    public function store(VariableFormRequest $Request)
    {
        $variable = new Variable;
        $variable->abreviatura = trim(\Request::input('abreviatura'));
        $variable->descripcion = trim(\Request::input('descripcion'));
        $variable->save();

        return redirect('indicadores/variable')->with('message', 'La variable "'.$variable->abreviatura.'" se guardo correctamente.');
    }


    public function edit($id)
    {
        $variable = Variable::findOrFail($id);
        
        return view('indicadores/variable/edit', ['variable'=>$variable]);
    }

    public function update(VariableFormRequest $Request, $id)
    {
        $variable = Variable::findOrFail($id);
        $variable->abreviatura = trim(\Request::input('abreviatura'));
        $variable->descripcion = trim(\Request::input('descripcion'));
        $variable->save();

        return redirect('indicadores/variable')->with('message', 'La variable  Nro. '.$id.' - '.$Request->abreviatura.' se actualizo correctamente.');
    }

    public function show($id)
    {
        $variable = Variable::findOrFail($id);
                
        return view('indicadores/variable/show', ['variable'=>$variable]);
    }

    public function destroy($id)
    {
        Variable::destroy($id);

        return redirect('indicadores/variable')->with('message', 'El Evaluador de Nro.- '.$id.'  se elimino correctamente.');
    }


    /* Cargos Evaluados*/
    public function cargosevaluados()
    {
        $evaluadores = Variable::all();

        return view('indicadores/variable/index', ['_TablaMes' => $evaluadores]);
    }


    public function agregarempleado($emp_id, $eva_id)
    {
        DB::table('evaluador_empleados')->insert(
            array('empleado_id' => $emp_id, 'evaluador_id' => $eva_id)
        );

        return $this->show($eva_id);
    }

    public function quitarempleado($emp_id, $eva_id)
    {
        DB::table('evaluador_empleados')->where('empleado_id', $emp_id)->where('evaluador_id', $eva_id)->delete();

        return $this->show($eva_id);
    }
}
