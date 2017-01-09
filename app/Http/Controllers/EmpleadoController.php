<?php

namespace ProyectoKpi\Http\Controllers;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;

use ProyectoKpi\Models\Empleado;
use ProyectoKpi\Models\Cargo;
use ProyectoKpi\User;
use ProyectoKpi\Models\Indicador;
use ProyectoKpi\Models\GrupoLocalizacion;
use ProyectoKpi\Models\Localizacion;
use ProyectoKpi\Models\GrupoDepartamento;
use ProyectoKpi\Models\Departamento;
use ProyectoKpi\Http\Controllers\GrupoDepartamentoController;
use ProyectoKpi\Http\Requests\EmpleadoFormRequest;
use ProyectoKpi\Http\Requests\EmpleadoRequestUpdate;




class EmpleadoController extends Controller
{
    /**
     * [TodosEmpleados Obtenemos la lista de todos los empleados]
     */
    public function TodosEmpleados()
    {
    	return Empleado::
						select('empleados.codigo','empleados.nombres','empleados.apellidos','localizaciones.nombre as localizacion','departamentos.nombre as departamento', 'users.name as usuario','users.email as correo', 'cargos.nombre as cargo')
							->join('localizaciones','localizaciones.id','=','empleados.localizacion_id')
							->join('departamentos','departamentos.id','=','empleados.departamento_id')
							->join('cargos','cargos.id','=','empleados.cargo_id')
							->join('users','users.id','=','empleados.user_id')
						->where('empleados.estado', '=', '1')->get();
    }

    /**
     * [obtenerEmpleado Obtenemos los datos de un Empleado]
     * @param  [int] $id [Id del Empleado]
     * @return [Array]     [Empleado]
     */
    public function obtenerEmpleado($id)
    {
    	return Empleado::
						select('empleados.codigo','empleados.nombres','empleados.apellidos',
								'departamentos.grupodep_id as grdepartamento','localizaciones.nombre as localizacion','localizaciones.id as localizacion_id','departamentos.id as departamento_id',
								'departamentos.nombre as departamento','localizaciones.grupoloc_id as grlocalizacion', 
								'grupo_departamentos.nombre as grupodepartamento','grupo_localizaciones.nombre as grupolocalizacion', 
								'users.name as usuario', 'users.type as tipo','users.email', 'cargos.id as cargo_id', 'cargos.nombre as cargo'

							  )
							->join('localizaciones','localizaciones.id','=','empleados.localizacion_id')
							->join('departamentos','departamentos.id','=','empleados.departamento_id')
							->join('grupo_departamentos','grupo_departamentos.id','=','departamentos.grupodep_id')
							->join('grupo_localizaciones','grupo_localizaciones.id','=','localizaciones.grupoloc_id')
							->join('cargos','cargos.id','=','empleados.cargo_id')
							->join('users','users.id','=','empleados.user_id')
						->where('empleados.estado', '=', '1')
						->where('empleados.codigo', '=', $id)
						->first();
    }


    /**
     * [obtenerIndicadores Obtenemos la Lista de Indicadores de un empleado]
     * @param  [type] $id [Id Empleado]
     * @return [type]     [description]
     */
    public function obtenerIndicadores($id)
    {
    	return $indicadores = Indicador::
						select('indicadores.id','indicadores.nombre','indicadores.orden','indicadores.descripcion_objetivo','indicadores.objetivo', 'indicadores.condicion', 'indicadores.frecuencia', 'indicadores.estado')
							->join('indicadores_cargos','indicadores_cargos.indicador_id','=','indicadores.id')
							->join('cargos','cargos.id','=','indicadores_cargos.cargo_id')
							->join('empleados','empleados.cargo_id','=','cargos.id')
						->where('indicadores.estado', '=', '1')
						->where('empleados.codigo', '=', $id)
						->get();
    }


    public function obtenerIndicadoresDisponibles($id,$idCargo)
    {
    	$indicadores = $this->obtenerIndicadores($id);
		
		$cargos_indicador = Cargo::find($idCargo)->indicadores()->where('indicadores_cargos.cargo_id','=', $idCargo)->get();

		$todos_indicadores = Indicador::select('indicadores.*')->where('estado', '=', '1')->get();

		return $todos_indicadores->diff($cargos_indicador);

    }


    /*** Metodos de las Vistas ******/


    public function index()
	{
		$empleados = $this->TodosEmpleados();

		return view('empleados/empleado/index')->with('empleados',$empleados);
	}

	public function create()
	{
		$cargos = Cargo::where('estado','=','1')->get();
		$grlocalizacion = GrupoLocalizacion::where('estado','=','1')->get();
		$localizacion = Localizacion::where('estado','=','1')->get();
		$grdepartamento = GrupoDepartamento::where('estado','=','1')->get();
		$departamento = Departamento::where('estado','=','1')->get();


		return view('empleados.empleado.create',['cargos'=>$cargos, 'grdepartamento'=>$grdepartamento, 'grlocalizacion'=>$grlocalizacion,'localizacion'=>$localizacion, 'departamento'=>$departamento]);
	}

	public function store(EmpleadoFormRequest $Request)
	{

		$users = new User;
		$users->name = $Request->usuario;
		$users->email = $Request->email;
		$users->type = $Request->type_id;
		$users->password =  \Hash::make($Request->password);
		$users->remember_token = \Hash::make($Request->password);
		$users->save();

		$useres = User::all();
		$user = $useres->pop();

		$empleado = new Empleado;
		$empleado->nombres = $Request->nombres;
		$empleado->apellidos = $Request->apellidos;
		$empleado->codigo = $Request->codigo;
		$empleado->departamento_id = $Request->departamento_id;
		$empleado->localizacion_id = $Request->localizacion_id;
		$empleado->cargo_id = $Request->cargo_id;
		$empleado->user_id = $user->id;
		$empleado->save();



		return redirect('empleados/empleado')->with('message', 'Se guardo correctamente.');

	}

	public function edit($id)
	{
		$empleado = $this->obtenerEmpleado($id);
		$cargos = Cargo::where('estado','=','1')->get();
		$grlocalizacion = GrupoLocalizacion::where('estado','=','1')->get();
		$localizacion = Localizacion::where('estado','=','1')->get();
		$grdepartamento = GrupoDepartamento::where('estado','=','1')->get();
		$departamento = Departamento::where('estado','=','1')->get();

		return view('empleados.empleado.edit',['empleado'=>$empleado,'cargos'=>$cargos, 'grdepartamento'=>$grdepartamento, 'grlocalizacion'=>$grlocalizacion,'localizacion'=>$localizacion, 'departamento'=>$departamento]);
	}

	public function update(EmpleadoRequestUpdate $Request,$id)
	{
		$empleado = Empleado::where('codigo','=', $id)->first();

		$users = User::where('id','=', $empleado->user_id)->get();
		$users->name = $Request->usuario;
		$users->email = $Request->email;
		$users->type = $Request->type_id;
		$users->save();

		$empleado->nombres = $Request->nombres;
		$empleado->apellidos = $Request->apellidos;
		$empleado->codigo = $Request->codigo;
		$empleado->departamento_id = $Request->departamento_id;
		$empleado->localizacion_id = $Request->localizacion_id;
		$empleado->cargo_id = $Request->cargo_id;
		var_dump($empleado); 
		$empleado->push();



		return redirect('empleados/empleado')->with('message', 'Se guardo correctamente.');
	}


	

	public function show($id)
	{
		$empleados = $this->obtenerEmpleado($id);

		$indicadoresLibres = $this->obtenerIndicadoresDisponibles($id,$empleados->cargo_id);
		
		return view('empleados.empleado.show',['empleados'=>$empleados, 'indicadores'=>$indicadoresLibres]);

	}

	public function destroy($id)
	{
		return "metodo destroy ".$id;

	}
}
