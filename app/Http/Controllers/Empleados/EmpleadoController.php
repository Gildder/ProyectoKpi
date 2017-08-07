<?php

namespace ProyectoKpi\Http\Controllers\Empleados;

use Illuminate\Http\Request;
use ProyectoKpi\Cms\Repositories\EmpleadoRepository;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Empleados\TipoUsuario;
use ProyectoKpi\Models\Evaluadores\Evaluador;
use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Models\Localizaciones\GrupoLocalizacion;
use ProyectoKpi\Models\Localizaciones\GrupoDepartamento;
use ProyectoKpi\Models\Localizaciones\Localizacion;
use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Http\Requests\Empleados\EmpleadoFormRequest;
use ProyectoKpi\Http\Requests\Empleados\EmpleadoRequestUpdate;
use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Models\User;

class EmpleadoController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }


    /**
     * [obtenerEmpleado Obtenemos los datos de un Empleado]
     * @param  [int] $id [Id del Empleado]
     * @return [Array]     [Empleado]
     */
    public function obtenerEmpleado($id)
    {
        return User::
            select('users.codigo', 'users.nombres', 'users.apellidos',
                    'departamentos.grupodep_id as grdepartamento', 'localizaciones.nombre as localizacion', 'localizaciones.id as localizacion_id', 'departamentos.id as departamento_id',
                    'departamentos.nombre as departamento', 'localizaciones.grupoloc_id as grlocalizacion',
                    'grupo_departamentos.nombre as grupodepartamento', 'grupo_localizaciones.nombre as grupolocalizacion',
                    'users.name as usuario', 'users.type as tipo', 'users.email', 'cargos.id as cargo_id', 'cargos.nombre as cargo'

                  )
                ->join('localizaciones', 'localizaciones.id', '=', 'users.localizacion_id')
                ->join('departamentos', 'departamentos.id', '=', 'users.departamento_id')
                ->join('grupo_departamentos', 'grupo_departamentos.id', '=', 'departamentos.grupodep_id')
                ->join('grupo_localizaciones', 'grupo_localizaciones.id', '=', 'localizaciones.grupoloc_id')
                ->join('cargos', 'cargos.id', '=', 'users.cargo_id')
            ->whereNull('users.deleted_at')
            ->where('users.id', '=', $id)
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
                        select('indicadores.id', 'indicadores.orden', 'indicadores.nombre', 'indicadores.descripcion_objetivo', 'indicadores.objetivo', 'tipos_indicadores.nombre as tipo', 'indicadores.condicion', 'frecuencias.nombre as frecuencia')
                            ->join('indicadores_cargos', 'indicadores_cargos.indicador_id', '=', 'indicadores.id')
                            ->join('cargos', 'cargos.id', '=', 'indicadores_cargos.cargo_id')
                            ->join('users', 'users.cargo_id', '=', 'cargos.id')
                            ->join('frecuencias', 'frecuencias.id', '=', 'indicadores.frecuencia_id')
                            ->join('tipos_indicadores', 'tipos_indicadores.id', '=', 'indicadores.tipo_indicador_id')
                        ->whereNull('users.deleted_at')
                        ->where('users.id', '=', $id)
                        ->get();
    }


    public function obtenerIndicadoresDisponibles($id, $idCargo)
    {
        $indicadores = $this->obtenerIndicadores($id);
        
        $cargos_indicador = Cargo::find($idCargo)->indicadores()->where('indicadores_cargos.cargo_id', '=', $idCargo)->get();

        $todos_indicadores = Indicador::select('indicadores.id', 'indicadores.orden', 'indicadores.nombre', 'indicadores.descripcion_objetivo', 'indicadores.objetivo', 'tipos_indicadores.nombre as tipo', 'indicadores.condicion', 'frecuencias.nombre as frecuencia')
                            ->join('frecuencias', 'frecuencias.id', '=', 'indicadores.frecuencia_id')
                            ->join('tipos_indicadores', 'tipos_indicadores.id', '=', 'indicadores.tipo_indicador_id')
                        ->whereNull('users.deleted_at')
                        ->get();

        return $todos_indicadores->diff($cargos_indicador);
    }



    /*** Metodos de las Vistas ******/


    public function index()
    {
        $empleados = EmpleadoRepository::obtenerEmpleados();

        return view('empleados/empleado/index')->with('empleados', $empleados);
    }

    public function create()
    {
        $cargos = Cargo::all();
        $grlocalizacion = GrupoLocalizacion::all();
        $localizacion = Localizacion::all();
        $grdepartamento = GrupoDepartamento::all();
        $departamento = Departamento::all();
        $tipoUsuario = tipoUsuario::all();

// var_dump(json_encode($grlocalizacion));

        return view('empleados.empleado.create', ['cargos'=>$cargos, 'grdepartamento'=>$grdepartamento, 'grlocalizacion'=>$grlocalizacion,'localizacion'=>$localizacion, 'departamento'=>$departamento, 'tipoUsuario'=>$tipoUsuario]);
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



        return redirect('empleados/empleado')->with('message', 'El Empleado de Codigo. "'.$empleado->codigo.'" se guardo correctamente.');
    }

    public function edit($id)
    {
        $empleado = EmpleadoRepository::obtenerEmpleado($id);
        $cargos = Cargo::all();
        $grlocalizacion = GrupoLocalizacion::all();
        $localizaciones = Localizacion::all();
        $grdepartamento = GrupoDepartamento::all();
        $departamentos = Departamento::all();
        $tipoUsuario = TipoUsuario::all();

//        dd($departamentos, $empleado, $localizaciones);

        return view('empleados.empleado.edit', ['empleado'=>$empleado,'cargos'=>$cargos, 'grdepartamento'=>$grdepartamento, 'grlocalizacion'=>$grlocalizacion,'localizaciones'=>$localizaciones, 'departamentos'=>$departamentos,'tipoUsuario'=> $tipoUsuario]);
    }

    public function update(EmpleadoRequestUpdate $request, $id)
    {
        $usuario = User::where('id', $id)->first();

        $usuario->nombres = trim($request->nombres);
        $usuario->apellidos = trim($request->apellidos);
        $usuario->codigo = trim($request->codigo);
        $usuario->departamento_id = $request->departamento_id;
        $usuario->localizacion_id = $request->localizacion_id;
        $usuario->cargo_id = $request->cargo_id;
        $usuario->name = trim($request->name);
        $usuario->email = trim($request->email);
        $usuario->type = $request->type;
//dd($usuario);
//        return redirect('empleados/empleado')->with('message', 'El Empleado '.$request->name.' se actualizo correctamente.');

        if($usuario->save()) {
            return redirect('empleados/empleado')->with('message', 'El Empleado '.$request->name.' se actualizo correctamente.');
        } else {
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('El Usuario NO se guardo, por favor verifique los campos')
                ->withInput();
        }
    }

    public function show($id)
    {
        $empleado = EmpleadoRepository::obtenerEmpleado($id);

        return view('empleados.empleado.show', ['empleado'=>$empleado]);
    }

    public function destroy($id)
    {
        Empleado::destroy($id);

        $empleado = User::findOrFail($id);

        return redirect('empleados/empleado')->with('message', 'El Empleado de Nombre Usuario.- '.$empleado->name.'  se elimino correctamente.');
    }

    public function listaDepartamento($id)
    {
        // $id = \Request::input('option');
        $grupo = GrupoDepartamento::find($id);
        return json_decode($grupo->departamentos) ;
    }

    public function listaLocalizacion($id)
    {
        // $id = \Request::input('option');
        $grupo = GrupoLocalizacion::find($id);
        return json_decode($grupo->localizaciones) ;
    }
}
