<?php

namespace ProyectoKpi\Http\Controllers\Indicadores;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use Illuminate\Support\Facades\DB;
use ProyectoKpi\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Collection;

use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\TipoIndicador;
use ProyectoKpi\Http\Requests\Indicadores\IndicadorFormRequest;
use ProyectoKpi\Models\Indicadores\Frecuencia;
use ProyectoKpi\Models\Indicadores\IndicadorCargo;
use ProyectoKpi\Http\Requests\Indicadores\IndicadorCargoFormRequest;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;

class IndicadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cargarOrden	()
    {
    	$ordenes = IndicadorRepository::NroOrdenOcupadas();
    	$collection = collect();

    	for ($i=0; $i < 21; $i++) { 
    		$collection->push($i);
    	}

    	$collection->forget(0);
    	foreach ($ordenes as $item) {
    		$collection->forget($item->orden);
    	}

    	return $collection;
    }

    
    public function index()
	{
		$this->cargarOrden();

		$indicadores = Indicador::select('indicadores.id','indicadores.orden','indicadores.nombre','indicadores.descripcion','tipos_indicadores.nombre as tipo')
			->join('tipos_indicadores','tipos_indicadores.id','=','indicadores.tipo_indicador_id')
			->whereNull('indicadores.deleted_at')->get();

		return view('indicadores/indicador/index')->with('indicadores', $indicadores);
	}


	public function create()
	{
		$tipo = TipoIndicador::all();
		$orden = $this->cargarOrden();

		return view('indicadores.indicador.create', ['tipo'=>$tipo, 'orden'=>$orden]);
	}

	public function store(IndicadorFormRequest $Request)
	{
		$indicador = new Indicador;
		$indicador->nombre = trim(\Request::input('nombre'));
		$indicador->orden = trim(\Request::input('orden'));
		$indicador->descripcion = trim(\Request::input('descripcion'));
		$indicador->tipo_indicador_id = \Request::input('tipo_indicador_id');
		$indicador->save();

		return redirect('indicadores/indicador')->with('message', 'El Indicador "'.$indicador->nombre.'" se guardo correctamente.');
		
	}

	public function edit($id)
	{
		$indicador = Indicador::findOrFail($id);
		$tipo = TipoIndicador::all();
		$orden = $this->cargarOrden();

		return view('indicadores/indicador/edit',['indicador'=>$indicador,'tipo'=>$tipo,'orden'=>$orden]);
	}

	public function update(IndicadorFormRequest $Request,$id)
	{

		$indicador = Indicador::findOrFail($id);
		$indicador->nombre = trim(\Request::input('nombre'));
		$indicador->orden = trim(\Request::input('orden'));
		$indicador->descripcion = trim(\Request::input('descripcion'));
		$indicador->tipo_indicador_id = \Request::input('tipo_indicador_id');
		$indicador->save();

		return redirect('indicadores/indicador')->with('message', 'El Indicador "'.$indicador->nombre.'" se actualizo correctamente.');
	}

	public function show($id)
	{

		$indicador = Indicador::select('indicadores.id','indicadores.orden','indicadores.nombre','indicadores.descripcion','tipos_indicadores.nombre as tipo')
								->join('tipos_indicadores','tipos_indicadores.id','=','indicadores.tipo_indicador_id')
								->where('indicadores.id', '=', $id)->first();

		return view('indicadores/indicador/show',['indicador'=>$indicador]);

	}

	public function destroy($id)
	{
		Indicador::destroy($id);
		
		return redirect('indicadores/indicador')->with('message', 'El Indicador Nro"'.$id.'" se elimino correctamente.');

	}

	public function quitar($indicador_id, $cargo_id)
	{

	    $cargos = DB::table('indicadores_cargos')
	            ->where('indicadores_cargos.indicador_id', $indicador_id)
	            ->where('indicadores_cargos.cargo_id', $cargo_id)
	            ->delete();

	   return $this->show($indicador_id);
		
	}

	public function asignados($id)
	{

	    $cargos = DB::table('indicadores')
	            ->join('indicadores_cargos', 'indicadores.id', '=', 'indicadores_cargos.indicador_id')
	            ->join('cargos', 'cargos.id', '=', 'indicadores_cargos.cargo_id')
	            ->select('cargos.*')
	            ->whereNull('cargos.deleted_at')
	            ->where('indicadores_cargos.indicador_id', '=', $id)
	            ->get();

		return view('indicadores/indicador/asignar',['cargos'=>$cargos]);
	}

	public function cargosevaluados()
	{
		$evaluadores = Evaluador::all();

		return view('empleados/evaluador/index', ['evaluadores'=> $evaluadores]);
	}

}
