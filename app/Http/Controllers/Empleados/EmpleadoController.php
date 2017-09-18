<?php

namespace ProyectoKpi\Http\Controllers\Empleados;

use ProyectoKpi\Cms\Repositories\EmpleadoRepository;
use ProyectoKpi\Http\Controllers\Controller;


use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Empleados\TipoUsuario;
use ProyectoKpi\Models\Empleados\UsuarioVacacion;
use ProyectoKpi\Models\Localizaciones\GrupoLocalizacion;
use ProyectoKpi\Models\Localizaciones\GrupoDepartamento;
use ProyectoKpi\Models\Localizaciones\Localizacion;
use ProyectoKpi\Models\Localizaciones\Departamento;
use ProyectoKpi\Http\Requests\Empleados\EmpleadoFormRequest;
use ProyectoKpi\Http\Requests\Empleados\EmpleadoRequestUpdate;
use ProyectoKpi\Models\User;

class EmpleadoController extends Controller
{


    /**
     * @param BaseRepository $empleadoRepository
     */
    public function __contruct()
    {
    }

    public function index()
    {
        $empleados = EmpleadoRepository::obtenerLista();


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

        return view('empleados.empleado.create', ['cargos'=>$cargos, 'grdepartamento'=>$grdepartamento, 'grlocalizacion'=>$grlocalizacion,'localizacion'=>$localizacion, 'departamento'=>$departamento, 'tipoUsuario'=>$tipoUsuario]);
    }

    public function store(EmpleadoFormRequest $request)
    {
        $usuario = new User;
        $usuario->active = $request->has('active')? 1 : 0;
        $usuario->vacacion = $request->has('vacacion')? 1 : 0;

        $usuario->tecnico_id = $request->tecnico_id;
        $usuario->color = $request->color==''?'#FFFFFF':$request->color;
        $usuario->name =  trim(\Request::input('usuario'));
        $usuario->email = trim(\Request::input('email'));
        $usuario->type = $request->type_id;
        $usuario->password =  \Hash::make($request->password);
        $usuario->remember_token = \Hash::make($request->password);

        $usuario->nombres = trim(\Request::input('nombres'));
        $usuario->apellidos = trim(\Request::input('apellidos'));
        $usuario->codigo = trim(\Request::input('codigo'));
        $usuario->departamento_id = $request->departamento_id;
        $usuario->localizacion_id = $request->localizacion_id;
        $usuario->cargo_id = $request->cargo_id;


		if ($usuario->save()) {
            return redirect('empleados/empleado')->with('message', 'El empleado "'.$usuario->name.'" se guardo correctamente.');
        } else {
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('El empleado NO se guardo, por favor verifique los campos')
                ->withInput();
        }
    }

    public function edit($id)
    {


        $empleado = EmpleadoRepository::obtenerEmpleado($id);
//        dd($empleado);

        $cargos = Cargo::all();
        $grlocalizacion = GrupoLocalizacion::all();
        $localizaciones = Localizacion::all();
        $grdepartamento = GrupoDepartamento::all();
        $departamentos = Departamento::all();
        $tipoUsuario = TipoUsuario::all();

        return view('empleados.empleado.edit', ['empleado'=>$empleado,'cargos'=>$cargos, 'grdepartamento'=>$grdepartamento, 'grlocalizacion'=>$grlocalizacion,'localizaciones'=>$localizaciones, 'departamentos'=>$departamentos,'tipoUsuario'=> $tipoUsuario]);
    }

    public function update(EmpleadoRequestUpdate $request, $id)
    {

        $usuario = User::where('id', $id)->first();
        $usuario->active = $request->has('active')? 1 : 0;
        $usuario->vacacion = $request->has('vacacion')? 1 : 0;

        $usuario->tecnico_id = $request->tecnico_id;
        $usuario->color = $request->color==''?'#FFFFFF':$request->color;
        $usuario->nombres = trim($request->nombres);
        $usuario->apellidos = trim($request->apellidos);
        $usuario->codigo = trim($request->codigo);
        $usuario->departamento_id = $request->departamento_id;
        $usuario->localizacion_id = $request->localizacion_id;
        $usuario->cargo_id = $request->cargo_id;
        $usuario->name = trim($request->name);
        $usuario->email = trim($request->email);
        $usuario->type = $request->type;

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
        $empleado = User::findOrFail($id);

        User::destroy($id);

        return redirect('empleados/empleado')->with('message', 'El Empleado de Nombre Usuario.- '.$empleado->name.'  se elimino correctamente.');
    }

    public function listaDepartamento($id)
    {
        // $id = \Request::input('option');
        $grupo = GrupoDepartamento::find($id);
        return json_decode($grupo->departamentos);
    }

    public function listaLocalizacion($id)
    {
        // $id = \Request::input('option');
        $grupo = GrupoLocalizacion::find($id);
        return json_decode($grupo->localizaciones) ;
    }

    public function eliminados()
    {
        $empleados = User::onlyTrashed()->get();

        return view('empleados/empleado/eliminados', ['empleados'=> $empleados]);
    }

    public function restaurar($id)
    {
        $usuario = User::withTrashed()
            ->where('id', $id)
            ->restore();

        $empleado = User::findOrFail($id);


        return redirect()->back()->with('message', 'Se restauro el usuario '.$empleado->name.' correctamente.');
    }

}
