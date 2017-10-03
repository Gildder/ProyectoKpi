<?php

namespace ProyectoKpi\Http\Controllers\Evaluadores;

use Illuminate\Http\Request;
use const null;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Evaluadores\Evaluador;
use ProyectoKpi\Models\Evaluadores\Ponderacion;
use ProyectoKpi\Http\Requests\Evaluadores\EvaluadorFormRequest;
use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Models\Indicadores\Frecuencia;
use ProyectoKpi\Models\User;

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

		$empleadosDisponibles =  Evaluador::usuariosNoEvalaudores($id);
        $empleadosAgregados = Evaluador::usuariosEvalaudores($id);

        $indicadoresDisponibles = DB::select('call pa_evaluadores_indicadoresDisponibles('.$id.');');

		$indicadores = IndicadorRepository::getIndicadoresDeEvaluador($id);

        $cargosDisponibles = DB::select('call pa_evaluadores_cargosDisponibles('.$id.');');
        $cargoAgregados = DB::select('call pa_evaluadores_cargosAgregados('.$id.');');


		return view('evaluadores/evaluador/show',['evaluador'=>$evaluador,'empleadosDisponibles'=>$empleadosDisponibles,'empleadosAgregados'=>$empleadosAgregados,
                'indicadores'=>$indicadores, 'indicadoresDisponibles'=>$indicadoresDisponibles, 'cargosDisponibles'=>$cargosDisponibles,'cargoAgregados'=>$cargoAgregados ]);
	}


    public function listaCargo($indicador_id, $evaluador_id)
    {
        return DB::select('call pa_evaluadores_indicadorCargos('.$indicador_id.', '.$evaluador_id.');');
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

	/* EMPLEADOS */
	public function agregarempleado($user_id, $evaluador_id)
    {
        $empleado = User::where('users.id', $user_id)->first();

        DB::table('evaluador_empleados')->insert(
            array('user_id' => $user_id, 'evaluador_id' => $evaluador_id)
        );

        //Actualizacion de Users en campos is_evaluador
        DB::table('users')->where(['id' => $user_id])
            ->update( array('is_evaluador' => 1, 'evaluador_id'=> $evaluador_id));


        return redirect()->back()->with('message', 'Se agrego el evaluador "'.$empleado->id.' - '.$empleado->name.' correctamente.');
    }

    public function quitarempleado($user_id, $evaluador_id)
    {
        $empleado = User::where('users.id', $user_id)->first();

        DB::table('evaluador_empleados')->where('user_id', $user_id)->where('evaluador_id', $evaluador_id)->delete();

        //Actualizacion de Users en campos is_evaluador
        DB::table('users')->where(['id' => $user_id])
            ->update( array('is_evaluador' => null, 'evaluador_id'=> null));

        return redirect()->back()->with('message', 'Se quito el evaluador "'.$empleado->id.' - '.$empleado->name.' correctamente.');
    }

    /* CARGOS */

    public function agregarcargo($cargo_id, $evaluador_id)
    {
        $cargo = Cargo::findOrFail($cargo_id);

        DB::table('evaluador_cargos')->insert(
            array('cargo_id' => $cargo_id, 'evaluador_id' => $evaluador_id)
        );

        return redirect()->back()->with('message', 'Se agrego el cargo "'.$cargo->nombre.'" correctamente.');
    }

   

    public function quitarcargo($cargo_id, $evaluador_id)
    {
        $cargo = Cargo::findOrFail($cargo_id);

        $isCargoConIndicador = DB::table('indicador_cargos')->where('cargo_id', $cargo_id)->where('evaluador_id', $evaluador_id)->count();

        // verificamos si cargo tiene indicador asignado
        if($isCargoConIndicador <= 0){
            DB::table('evaluador_cargos')->where('cargo_id', $cargo_id)->where('evaluador_id', $evaluador_id)->delete();
        
            return redirect()->back()->with('message', 'Se quito el cargo "'.$cargo->nombre.'" correctamente.');
        }else{
            return redirect()->back()->withErrors('No puede quitar cargo "'.$cargo->nombre.'" porque esta asignado a un indicador.');
        }

        
    }

    /* INDICADORES */

    /* Nuevo Indicador */
    public function agregarindicador(Request $Request, $evaluador_id)
    {

    	//  salvando tareas por localizacion
		$indicadores = $Request->input('prov',[]);

		for($i = 0; $i < count($indicadores); $i++)
		{
	       DB::table('evaluador_indicadores')->insert(
	            array('indicador_id' => $indicadores[$i], 'evaluador_id' => $evaluador_id)
	        );
		}


        return redirect()->back()->with('message', 'Se agrego el indicador correctamente.');
    }

    public function quitarindicador($indicador_id, $evaluador_id)
    {
    	$existeCargaConIndicador = DB::select('call pa_evaluadores_existeCargoIndicador('.$indicador_id.','.$evaluador_id.');');

    	$indicador = Indicador::findOrFail($indicador_id);


        if($existeCargaConIndicador[0]->cantidad > 0)
        {
            // \Session::flash('No se puede quitar, el indicador '.$indicador->nombre.' tiene cargos agregados.');
            return redirect()->back()->withErrors( 'No se puede quitar, el indicador "'.$indicador->nombre.'" tiene cargos agregados.');
        }else{
            DB::table('evaluador_indicadores')
                ->where('indicador_id', '=', $indicador_id)
                ->where('evaluador_id', '=',$evaluador_id)
                ->delete();
        	
        	return redirect()->back()->with('message', 'Se quito el indicador "'.$indicador->nombre.'" correctamente.');
    	}

    }

    /* Asignar Cargos */

    public function asignarcargo($indicador_id, $evaluador_id)
    {
        $frecuencia = Frecuencia::all();
        $evaluador = Evaluador::findOrFail($evaluador_id);
        $indicador = Indicador::findOrFail($indicador_id);

        $cargosEvaluadores = DB::select('call pa_evaluadores_cargosEvaluados('.$indicador_id.', '.$evaluador_id.');');
        $indicadorCargos = DB::select('call pa_evaluadores_indicadorCargos('.$indicador_id.','.$evaluador_id.');');
        $cargos = DB::select('call pa_evaluadores_cargosAgregados('.$evaluador->id.');');

        return view('evaluadores/evaluador/indicadores/asignar_cargos', 
            [ 'indicador' => $indicador,'evaluador' => $evaluador,'frecuencia' => $frecuencia,
    		 'indicadorCargos' => $indicadorCargos, 'cargosEvaluadores'=> $cargosEvaluadores, 'cargos'=>$cargos]);
    }

    public function agregarcargoasignado($indicador_id, $evaluador_id, Request $Request)
    {
        /* validamos los parametros enviados */
        $validator = \Validator::make($Request->all(), [
            'cargo_id' => 'required',
            'condicion'=>'max:120',
            'aclaraciones'=>'max:120',
            'objetivo'=>'required',
            'frecuencia_id'=>'required',
        ]);

        if($validator->fails())
        {
           return Redirect::back()->withErrors($validator)->withInput();
        }

        $cargo_id = \Request::input('cargo_id');
        $frecuencia_id = \Request::input('frecuencia_id');
        $objetivo = \Request::input('objetivo');
        $aclaraciones = trim(\Request::input('aclaraciones'));
        $condicion = trim(\Request::input('condicion'));

        $cargo = Cargo::findOrFail($cargo_id);

        /* insertamos el indicador al cargo asignado */
        $ids = DB::table('indicador_cargos')->insertGetId(
            array('indicador_id' => $indicador_id, 'evaluador_id' => $evaluador_id, 'cargo_id' => $cargo_id, 'frecuencia_id' => $frecuencia_id, 'objetivo'=>$objetivo, 'aclaraciones'=> $aclaraciones, 'condicion'=>$condicion)
        );

        //Actualizacion de Users en campos is_evaluador
        DB::table('users')->where(['cargo_id' => $cargo_id])
            ->update( array('evaluado_por'=> $evaluador_id));

        return redirect()->back()->with('message', 'Se agrego el cargo "'.$cargo->nombre.'" correctamente.' );

    }

    public function editarcargoasignado($indicador_id, $evaluador_id, Request $Request)
    {
        $validator = \Validator::make($Request->all(), [
            'cargo_id' => 'required',
            'condicion'=>'max:120',
            'aclaraciones'=>'max:120',
            'objetivo'=>'required',
            'frecuencia_id'=>'required',
        ]);

        if($validator->fails())
        {
           return Redirect::back()->withErrors($validator)->withInput();
        }
        $cargo_idOld = \Request::input('cargo_idOld');
        $cargo_id = \Request::input('cargo_id');
        $frecuencia_id = \Request::input('frecuencia_id');
        $objetivo = \Request::input('objetivo');
        $aclaraciones = trim(\Request::input('aclaraciones'));
        $condicion = trim(\Request::input('condicion'));

        $cargo = Cargo::findOrFail($cargo_id);


        // dd($cargo_id, $cargo_idOld);
        
        DB::table('indicador_cargos')->where(['indicador_id' => $indicador_id, 'evaluador_id' => $evaluador_id,  'cargo_id' => $cargo_idOld])
                                     ->update( array('cargo_id' => $cargo_id, 'frecuencia_id' => $frecuencia_id, 'objetivo'=>$objetivo, 'aclaraciones'=> $aclaraciones, 'condicion'=>$condicion));

        //Actualizacion de Users en campos is_evaluador
        DB::table('users')->where(['cargo_id' => $cargo_idOld])
            ->update( array('evaluado_por'=> null));

        DB::table('users')->where(['cargo_id' => $cargo_id])
            ->update( array('evaluado_por'=> $evaluador_id));

        return redirect()->back()->with('message', 'Se modifico el cargo "'.$cargo->nombre.'" correctamente.' );
    }

    public function quitarcargoasignado($indicador_id, $evaluador_id, $cargo_id)
    {
        DB::table('indicador_cargos')->where('indicador_id', $indicador_id)->where('evaluador_id', $evaluador_id)->where('cargo_id', $cargo_id)->delete();

        $cargo = Cargo::findOrFail($cargo_id);

        //Actualizacion de Users en campos is_evaluador
        DB::table('users')->where(['cargo_id' => $cargo_id])
            ->update( array('evaluado_por'=> null));

        return redirect()->back()->with('message', 'Se quito el cargo '.$cargo->nombre.' correctamente.');
    }

   

}
