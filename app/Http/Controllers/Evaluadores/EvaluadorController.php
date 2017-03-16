<?php

namespace ProyectoKpi\Http\Controllers\Evaluadores;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Http\Requests;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Models\Evaluadores\Evaluador;
use ProyectoKpi\Models\Evaluadores\Ponderacion;
use ProyectoKpi\Http\Requests\Evaluadores\EvaluadorFormRequest;
use ProyectoKpi\Http\Models\Evaluadores\EvaluadorEmpleado;



class EvaluadorController extends Controller
{
	public function __contruct()
   	{
   		$this->middleware('auth');
   	}

   	
    public function index()
	{
		$evaluadores = Evaluador::all();

		return view('evaluadores/evaluador/index', ['evaluadores'=> $evaluadores]);
	}

	public function create()
	{
		$ponderaciones = Ponderacion::all();

		return view('evaluadores.evaluador.create', ['ponderaciones'=> $ponderaciones]);
		
	}

	public function store(EvaluadorFormRequest $Request)
	{
		$evaluador = new Evaluador;
		$evaluador->abreviatura = trim(\Request::input('abreviatura'));
		$evaluador->descripcion = trim(\Request::input('descripcion'));
		$evaluador->ponderacion_id = $Request->ponderacion_id;
		$evaluador->save();

		return redirect('evaluadores/evaluador')->with('message', 'La Gerencia Evaluadora "'.$evaluador->abreviatura.'" se guardo correctamente.');
	}


	public function edit($id)
	{
		$evaluador = Evaluador::findOrFail($id);
		$ponderaciones = Ponderacion::all();

		return view('evaluadores/evaluador/edit',['evaluador'=>$evaluador, 'ponderaciones'=>$ponderaciones]);
	}

	public function update(EvaluadorFormRequest $Request, $id)
	{

		$evaluador = Evaluador::findOrFail($id);
		$evaluador->abreviatura = trim(\Request::input('abreviatura'));
		$evaluador->descripcion = trim(\Request::input('descripcion'));
		$evaluador->save();

		return redirect('evaluadores/evaluador')->with('message',  'La Gerencia Evaluadora Nro. '.$id.' - '.$Request->abreviatura.' se actualizo correctamente.');
	}


	public function show($id)
	{
		$evaluador = Evaluador::findOrFail($id);
		
		$empleadosDisponibles = DB::select('call pa_evaluadores_empleadosDisponibles('.$id.');');
        $empleadosEvaluadores = DB::select('call pa_evaluadores_empleadosEvaluadores('.$id.');');

        $cargosDisponibles = DB::select('call pa_evaluadores_cargosDisponibles('.$id.');');
        $cargosEvaluadores = DB::select('call pa_evaluadores_cargosEvaluados('.$id.');');

				
		return view('evaluadores/evaluador/show',['evaluador'=>$evaluador,'empleadosdis'=>$empleadosDisponibles,'empleadosup'=>$empleadosEvaluadores, 'cargosdis'=>$cargosDisponibles,'cargosup'=>$cargosEvaluadores]);
	}

	public function destroy($id)
	{
		Evaluador::destroy($id);

		return redirect('evaluadores/evaluador')->with('message',  'La Gerencia Evaluadora de Nro.- '.$id.'  se elimino correctamente.');
	}


	/* Cargos Evaluados*/

	public function cargosevaluados()
	{
		$evaluadores = Evaluador::all();

		return view('evaluadores/evaluador/index', ['evaluadores'=> $evaluadores]);
	}


	public function agregarempleado($emp_id, $eva_id)
    {
        DB::table('evaluador_empleados')->insert(
            array('empleado_id' => $emp_id, 'evaluador_id' => $eva_id)
        );
        return redirect()->back()->with('message', 'Se agrego el evaluador '.$emp_id.' correctamente.');
    }

    public function quitarempleado($emp_id, $eva_id)
    {
        DB::table('evaluador_empleados')->where('empleado_id', $emp_id)->where('evaluador_id', $eva_id)->delete();

        return redirect()->back()->with('message', 'Se quito el evaluador '.$emp_id.' correctamente.');
        
    }

    public function agregarcargo($cargo_id, $eva_id)
    {
        DB::table('evaluador_cargos')->insert(
            array('cargo_id' => $cargo_id, 'evaluador_id' => $eva_id)
        );

        return redirect()->back()->with('message', 'Se agrego el cargo '.$cargo_id.' correctamente.');
    }

    public function quitarcargo($cargo_id, $eva_id)
    {
        DB::table('evaluador_cargos')->where('cargo_id', $cargo_id)->where('evaluador_id', $eva_id)->delete();

        return redirect()->back()->with('message', 'Se quito el cargo '.$cargo_id.' correctamente.');
    }

}