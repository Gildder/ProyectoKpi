<?php

namespace ProyectoKpi\Http\Controllers\Localizaciones;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;


use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Models\Localizaciones\GrupoDepartamento;
use ProyectoKpi\Models\Localizaciones\LocalizacionesGrupoDepartamento;
use ProyectoKpi\Http\Requests\Localizaciones\DepartamentoFormRequest;
use ProyectoKpi\Http\Requests\Localizaciones\DepartamentoRequestUpdate;

use ProyectoKpi\Repositories\DepartamentoRepository;


class DepartamentoController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function __contruct()
   	{
   	}


    public function index()
	{	
		$departamentos = Departamento::getDepartamentos();

		return view('localizaciones/departamento/index')->with('departamentos', $departamentos );

	}

	public function create()
	{
		return view('localizaciones.departamento.create',['grupo'=> GrupoDepartamento::all()]);
	}

	public function store(DepartamentoFormRequest $Request)
	{
		$departamento = new Departamento;
		$departamento->nombre = trim(\Request::input('nombre'));
		$departamento->grupodep_id = $Request->grupodep_id;
		$departamento->save();

		return redirect('localizaciones/departamento')->with('message', 'El Departamento "'.$departamento->nombre.'" se guardo correctamente.');
	}

	public function edit($id)
	{
		$departamento = Departamento::findOrFail($id);
		$grupo = GrupoDepartamento::all();

		return view('localizaciones.departamento.edit',['departamento'=>$departamento,'grupo'=>$grupo]);
	}

	public function update(DepartamentoFormRequest $Request,$id)
	{
		$departamento = Departamento::findOrFail($id);
		$departamento->nombre = trim(\Request::input('nombre'));
		$departamento->grupodep_id = $Request->grupodep_id;
		$departamento->save();

		return redirect('localizaciones/departamento')->with('message',  'El Departamento Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function show($id)
	{
		$departamento = Departamento::findOrFail($id);
		return response()->json($departamento);
	}

	public  function destroy($id)
	{
		Departamento::destroy($id);		

		return redirect('localizaciones/departamento')->with('message', 'El Departamento de Nro.- '.$id.'  se elimino correctamente.');
	}

	public function eliminados()
	{
		$departamentos = Departamento::onlyTrashed()->get();
		
		return view('localizaciones/departamento/eliminados', ['departamentos'=> $departamentos]);
	}
	
	function restaurar($id)
	{
		$cargo = Departamento::withTrashed()
        ->where('id', $id)
        ->restore();

		return redirect()->back()->with('message', 'El departamento '.$id.' se restauro correctamente.');
	}

}
