<?php

namespace ProyectoKpi\Http\Controllers;

use ProyectoKpi\Models\Indicador;

use ProyectoKpi\Models\Cargo;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;

use Illuminate\Support\Facades\DB;

use Session;

class IndicadorController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest');
    }

    
    public function index()
	{
		$indicadores = Indicador::select('id','orden','nombre','descripcion_objetivo','objetivo','tipo_indicador_id','condicion',  'frecuencia' ,'created_at','updated_at')->where('indicadores.estado', '=', '1')->get();

		return view('indicadores/indicador/index')->with('indicadores', $indicadores);
	}


	public function create()
	{
		return 'Store';
	}

	public function store(GrupoDepartamentoFormRequest $Request)
	{
		return 'Store';
	}

	public function edit($id)
	{
		$indicador = Indicador::findOrFail($id);
		$cargos_indicardor = Indicador::find($id)->cargos()->where('indicadores_cargos.indicador_id','=',$id)->get();

		$todos_cargos = Cargo::select('cargos.*')
								->where('estado', '=', '1')->get();

		$cargos_libres = $todos_cargos->diff($cargos_indicardor);
    	//var_dump($cargos_libres);

		return view('indicadores/indicador/edit',['indicador'=>$indicador,'cargos_indicardor'=>$cargos_indicardor,'cargos_libres'=>$cargos_libres]);
	}

	public function update(Request $Request,$id)
	{

		$indicador = Indicador::findOrFail($id);

    	$nuevos_cargos = $Request->input('prov',[]);

    	var_dump($nuevos_cargos);
    		
    		for($i = 0; $i < count($nuevos_cargos); ++$i)
    		{

	    DB::table('indicadores_cargos')->insert(
			    	['indicador_id' => $id, 'cargo_id' => $nuevos_cargos[$i] ]
	    			//var_dump($nuevos_cargos[$i]);
	    );
    		
    		}

		//return redirect('indicadores/indicador/edit')->with('message', 'Se modifico correctamente.');
		return view('indicadores.indicador');
	}

	public function show($id)
	{

		return view('indicadores.indicador.show');
	}

	public function destroy($id)
	{
		$indicador = Indicador::findOrFail($id);

		return ;
	}

	public function quitar($indicador_id, $cargo_id)
	{

	    $cargos = DB::table('indicadores_cargos')
	            ->where('indicadores_cargos.indicador_id', $indicador_id)
	            ->where('indicadores_cargos.cargo_id', $cargo_id)
	            ->delete();

	    $indicador = Indicador::findOrFail($indicador_id);
		$cargos_indicardor = Indicador::find($indicador_id)->cargos()->where('indicadores_cargos.indicador_id','=',$indicador_id)->get();

		$todos_cargos = Cargo::select('cargos.*')
								->where('estado', '=', '1')->get();

		$cargos_libres = $todos_cargos->diff($cargos_indicardor);

		return view('indicadores/indicador/edit',['indicador'=>$indicador,'cargos_indicardor'=>$cargos_indicardor,'cargos_libres'=>$cargos_libres]);
		
	}

	public function asign($id)
	{

	    $cargos = DB::table('indicadores')
	            ->join('indicadores_cargos', 'indicadores.id', '=', 'indicadores_cargos.indicador_id')
	            ->join('cargos', 'cargos.id', '=', 'indicadores_cargos.cargo_id')
	            ->select('cargos.*')
	            ->where('cargos.estado', '=', '1')
	            ->where('indicadores_cargos.indicador_id', '=', $id)
	            ->get();

		return view('indicadores/indicador/asignar',['cargos'=>$cargos]);
	}

}
