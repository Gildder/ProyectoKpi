<?php

namespace ProyectoKpi\Http\Controllers\Supervisores;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use ProyectoKpi\Cms\Clases\Caches;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use ProyectoKpi\Models\Localizaciones\Localizacion;
use ProyectoKpi\Models\Tareas\Estados;
use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Models\Empleados\Supervisados;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;
use ProyectoKpi\Http\Requests\Indicadores\ErrorFormRequest;
use ProyectoKpi\Models\User;

class SupervisadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $tareas = Supervisados::getTareasSupervisados(0);

//        dd($tareas);
        $semanas = array_pop($tareas);

        return view('supervisores\supervisados\tareas\index', ['tareas'=> $tareas, 'semanas'=> $semanas]);
    }

    public function show($user_id)
    {
        // Lista de indicadores supervisados a un empleado supervisado
        $indicadores = IndicadorRepository::cnGetListaInidicadores($user_id);
        // informacion del empleado supervisado
        $usuario = User::where('id', $user_id)->first();

//        dd(json_encode( $user_id), $usuario);

        return view('supervisores\supervisados\show', ['indicadores'=>$indicadores, 'usuario'=>$usuario]);
    }

    // tareas finalizadas estado = 3 isError = 0
    public function obtenerTareasFinalizadas($anio, $mes, $semana, $empleado_id)
    {
        // obtener las tareas finalizadas con los parametros enviados, mas los tareas que estan marcadas con errores de manera desabilitada
        // pero espeficicando que ya esta agregada con error
        $tareas = DB::select("call pa_eficiencia_tareasTerminadas(".$anio.", ".$mes.", ".$semana.", '".$empleado_id."',0);");

        return view('supervisores\numeroErrores\create', ['tareas'=> $tareas, 'empleado_id'=>$empleado_id]);
    }

    // tareas finalizadas estado  = 3 isError = 1
    public function obtenerTareasErrores($anio, $mes, $semana, $empleado_id)
    {
        // obtener las tareas finalizadas con los parametros enviados, mas los tareas que estan marcadas con errores de manera desabilitada
        // pero espeficicando que ya esta agregada con error
        $tareas = DB::select("call pa_eficiencia_tareasTerminadas(".$anio.", ".$mes.", ".$semana.", '".$empleado_id."', 1);");

        return view('supervisores\numeroErrores\delete', ['tareas'=> $tareas, 'empleado_id'=>$empleado_id]);
    }

    public function agregarErrorTarea(ErrorFormRequest $Request, $empleado_id)
    {
        $tarea_id = \Request::input('tarea_id');
        $descripcion = trim(\Request::input('descripcion'));

        // dd($tarea_id, $descripcion);

        $tarea = Tarea::findOrFail($tarea_id);
        $tarea->isError = 1;
        $tarea->save();

        $nota_id = DB::table('nota_errores')->insertGetId([
            'descripcion'=> $descripcion,
            'tarea_id'=> $tarea_id,
            'razonNota'=> 1,
            'supervisor_id'=> $empleado_id,
        ]);
        
        
        DB::select("call pa_eficiencia_actualizarNroErrores('".$tarea->fechaFinSolucion."', '".$empleado_id."', 1);");
        return redirect()->back()->with('El numero de Errores se aumento correctamente.');
    }

    public function quitarErrorTarea(ErrorFormRequest $Request, $empleado_id)
    {
        $tarea_id = \Request::input('tarea_id');
        $descripcion = trim(\Request::input('descripcion'));

        // dd($tarea_id, $descripcion);

        $tarea = Tarea::findOrFail($tarea_id);
        $tarea->isError = 0;
        $tarea->save();

        $nota_id = DB::table('nota_errores')->insertGetId([
            'descripcion'=> $descripcion,
            'tarea_id'=> $tarea_id,
            'razonNota'=> 0,
            'supervisor_id'=> $empleado_id,
        ]);
        
        
        DB::select("call pa_eficiencia_actualizarNroErrores('".$tarea->fechaFinSolucion."', '".$empleado_id."', 0);");
        return redirect()->back()->with('El numero de Errores se aumento correctamente.');
    }

    public function obtenerListaDeIndicadoresDelSupervisado($empleado_id)
    {
        $indicadores = IndicadorRepository::cnGetListaInidicadores($empleado_id);

    }

    public function verTareasSupervisados()
    {
        $semanas = Tarea::getSemanasTareas(date('Y-m-d'));

        $tareas = Tarea::getTareasSupervisados($semanas->fechaInicio, $semanas->fechaFin);

        return view('supervisores\supervisados\tareas\index', ['tareas'=> $tareas, 'semanas'=> $semanas]);
    }

    /**
     * Busquedas de tareas archivadas o de semanas anteriores de los empleados supervisados
    */
    public function busquedas()
    {
        $tareas = Cache::get('tareasSupervisadas');

//        dd($tareas);
        return view('supervisores\supervisados\tareas\busquedas', [
            'id'=> \Auth::user()->id,
            'usuarios' => Supervisados::usuariosSupervisados(\Auth::user()->id),
            'cargos' => Supervisados::cargosSupervisados(\Auth::user()->id),
            'departamentos' => Supervisados::departamentosSupervisados(\Auth::user()->id),
            'estados'=> Estados::getEstados(),
            'localizaciones'=>  Localizacion::getLocalizaciones(),
            'tareas' => $tareas
        ]);
    }

    public function buscar(Request $request)
    {
        $tareas= Supervisados::filtrarTareas($request);
        if($tareas['success']){
            Cache::forget('tareasSupervisadas');
            Cache::forever('tareasSupervisadas',$tareas['tareas']);
        }

        if(sizeof($tareas['tareas'])>0){
            return redirect()->back()->withInput();
        }else{
            return  redirect()->back()->withInput();
        }

    }

    /* Metodos Ajax */
    public function getUsuarioSupervisados(Request $request)
    {
            $usuarios = Supervisados::usuariosSupervisados($request->id);

            return ['usuarios' => $usuarios];
    }

    public function getCargosSupervisados(Request $request)
    {
            $cargos = Supervisados::cargosSupervisados($request->id);

            return ['cargos'=> $cargos];
    }

    public function getDepartamentosSupervisados(Request $request)
    {
        $departamentos = Supervisados::departamentosSupervisados($request->id);

        return ['departamentos'=> $departamentos];
    }

    public function getEstados(Request $request)
    {
            $estados = Estados::getEstados();

            return ['estados'=> $estados];
    }

    public static function getLocalizaciones(Request $request)
    {
            $localizaciones = Localizacion::getLocalizaciones();

            return ['localizaciones'=> $localizaciones];
    }
}
