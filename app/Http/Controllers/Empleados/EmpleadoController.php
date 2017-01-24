<?php

namespace ProyectoKpi\Http\Controllers\Empleados;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use ProyectoKpi\User;


use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Models\Localizaciones\GrupoLocalizacion;
use ProyectoKpi\Models\Localizaciones\GrupoDepartamento;
use ProyectoKpi\Models\Localizaciones\Localizacion;
use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Http\Controllers\Localizaciones\GrupoDepartamentoController;
use ProyectoKpi\Http\Requests\Empleados\EmpleadoFormRequest;
use ProyectoKpi\Http\Requests\Empleados\EmpleadoRequestUpdate;

class EmpleadoController extends Controller
{


    /*** Metodos de las Vistas ******/


    public function index()
	{
		$empleados = Empleado::TodosEmpleados();

		return view('empleados/empleado/index')->with('empleados',$empleados);
	}

	public function create()
	{
		$cargos = Cargo::all();
		$grlocalizacion = GrupoLocalizacion::all();
		$localizacion = Localizacion::all();
		$grdepartamento = GrupoDepartamento::all();
		$departamento = Departamento::all();


		return view('empleados.empleado.create',['cargos'=>$cargos, 'grdepartamento'=>$grdepartamento, 'grlocalizacion'=>$grlocalizacion,'localizacion'=>$localizacion, 'departamento'=>$departamento]);
	}

	public function store(EmpleadoFormRequest $Request)
	{

		$users = new User;
		$users->name =  trim(\Request::input('usuario'));
		$users->email = trim(\Request::input('email'));
		$users->type = $Request->type_id;
		$users->password =  \Hash::make($Request->password);
		$users->remember_token = \Hash::make($Request->password);
		$users->save();

		$useres = User::all();
		$user = $useres->pop();

		$empleado = new Empleado;
		$empleado->nombres = trim(\Request::input('nombres'));
		$empleado->apellidos = trim(\Request::input('apellidos'));
		$empleado->codigo = trim(\Request::input('codigo'));
		$empleado->departamento_id = $Request->departamento_id;
		$empleado->localizacion_id = $Request->localizacion_id;
		$empleado->cargo_id = $Request->cargo_id;
		$empleado->user_id = $user->id;
		$empleado->save();



		return redirect('empleados/empleado')->with('message','El Empleaado de Codigo. "'.$empleado->codigo.'" se guardo correctamente.');

	}

	public function edit($id)
	{
		$empleado = Empleado::obtenerEmpleado($id);
		$cargos = Cargo::all();
		$grlocalizacion = GrupoLocalizacion::all();
		$localizacion = Localizacion::all();
		$grdepartamento = GrupoDepartamento::all();
		$departamento = Departamento::all();

		return view('empleados.empleado.edit',['empleado'=>$empleado,'cargos'=>$cargos, 'grdepartamento'=>$grdepartamento, 'grlocalizacion'=>$grlocalizacion,'localizacion'=>$localizacion, 'departamento'=>$departamento]);
	}

	public function update(EmpleadoRequestUpdate $Request,$id)
	{

		$empleado = Empleado::where('codigo',$id)->first();

		DB::table('empleados')->where('codigo',$id)->update(['nombres' => $Request->nombres,'apellidos' => $Request->apellidos,'codigo' => $Request->codigo,'departamento_id' => $Request->departamento_id,'localizacion_id' => $Request->localizacion_id,'cargo_id' => $Request->cargo_id]);

		DB::table('users')->where('id', $empleado->user_id)->update(['name' => $Request->usuario,'email' => $Request->email,'type' => $Request->type_id]);

		return redirect('empleados/empleado')->with('message', 'El Empleado Codigo. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function show($id)
	{
		$empleados = Empleado::todosEmpleados();
		$indicadores = Empleado::obtenerIndicadores($id);

		return view('empleados.empleado.show',['empleados'=>$empleados, 'indicadores'=>$indicadores]);
	}

	public function destroy($id)
	{
		$result = DB::table('empleados')->where('codigo', $id)->update(['estado' => 0]);		

		return redirect('empleados/empleado')->with('message',  'El Empleado de Codigo.- '.$id.'  se elimino correctamente.');

	}
}
