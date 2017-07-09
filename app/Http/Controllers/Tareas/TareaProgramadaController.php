<?php

namespace ProyectoKpi\Http\Controllers\Tareas;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Models\Localizaciones\Localizacion;
use ProyectoKpi\Http\Requests\Tareas\TareaProgramasFormRequest;
use ProyectoKpi\Http\Requests\Tareas\TareaProgramasResolverRequest;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use ProyectoKpi\Events\Tarea\TareaSaved;
use ProyectoKpi\Events\Tarea\TareaUpdating;
use ProyectoKpi\Events\Tarea\TareaUpdated;

class TareaProgramadaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // obtenemos las tareas programadas
        $tareas = TareaRepository::getTareasProgramadas();
        // obtenemos la semana de tarea
        $semanas = TareaRepository::getSemanasTareas(date('Y-m-d'));

// dd($tareas);

        return view('tareas/tareaProgramadas/index', ['tareas'=> $tareas, 'semanas'=> $semanas]);
    }

    public function archivados()
    {
        $tareas = TareaRepository::getTareasArchivados();
        $semanas = TareaRepository::getSemanasTareas(date('Y-m-d'));

        return view('tareas/tareaProgramadas/archivados', ['tareas'=> $tareas,  'semanas'=> $semanas]);
    }

    public function eliminados()
    {
        return view('tareas/tareaProgramadas/eliminados');
    }

    public function create()
    {
        $semanas = TareaRepository::getSemanasTareas(date('Y-m-d'));

        return view('tareas.tareaProgramadas.create', [ 'semanas'=> $semanas]);
    }

    public function store(TareaProgramasFormRequest $Request)
    {
        $user = Auth::user();  //obtenemos el usuario logueado
        
        $tarea = new Tarea;
        $tarea->descripcion = trim(\Request::input('descripcion'));
        $fechaInicio = trim(\Request::input('fechaInicioEstimado'));
        $fechaFin = trim(\Request::input('fechaFinEstimado'));
        // convertimos a fecha
        $fechaInicio = $tarea->cambiarFormatoDB($fechaInicio);
        $tarea->fechaInicioEstimado = $fechaInicio;

        // convertimos a fecha
        $fechaFin = $tarea->cambiarFormatoDB($fechaFin);
        $tarea->fechaFinEstimado = $fechaFin;

        $horaReal = $tarea->obtenerHora(trim(\Request::input('hora')), trim(\Request::input('minuto')));

        $tarea->tiempoEstimado = $horaReal[0].':'.$horaReal[1];
        $tarea->tipoTarea_id = '1';
        $tarea->estadoTarea_id = '1';
        $tarea->user_id = $user->id;

        if ($tarea->save()) {
            // $eventSaved = \Event::fire(new TareaSaved($tarea));

            return redirect('tareas/tareaProgramadas')->with('message', 'El tarea "'.$tarea->descripcion.'" se guardo correctamente.');
        } else {
            return back()->withInput();
        }
    }

    
    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);
        $semanas = TareaRepository::getSemanasTareas($tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado));
        
        return view('tareas/tareaProgramadas/edit', ['tarea'=>$tarea, 'semanas'=>$semanas]);
    }

    public function update(TareaProgramasFormRequest $Request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        // Evento para actualizar indicador
        // $eventUpdating = \Event::fire(new TareaUpdating($tarea));


        $tarea->descripcion = trim(\Request::input('descripcion'));
        $tarea->estado = 1;
        $fechaInicio = trim(\Request::input('fechaInicioEstimado'));
        $fechaFin = trim(\Request::input('fechaFinEstimado'));
        
        // convertimos a fecha
        $fechaInicio = $tarea->cambiarFormatoDB($fechaInicio);
        $tarea->fechaInicioEstimado = $fechaInicio;

        // convertimos a fecha
        $fechaFin = $tarea->cambiarFormatoDB($fechaFin);
        $tarea->fechaFinEstimado = $fechaFin;

        $horaReal = $tarea->obtenerHora(trim(\Request::input('hora')), trim(\Request::input('minuto')));
        $tarea->tiempoEstimado = $horaReal[0].':'.$horaReal[1];


        if ($tarea->save()) {
            // $eventSaved = \Event::fire(new TareaUpdated($tarea));

            return redirect('tareas/tareaProgramadas')->with('message', 'El tarea Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
        } else {
            return back()->withInput();
        }
    }

    public function show($id)
    {
        $tareaProgramadas = Tarea::findOrFail($id);

        return view('tareas/tareaProgramadas/show', ['tarea'=>$tareaProgramadas]);
    }

    public function resolver($id)
    {
        $tareaProgramadas = Tarea::findOrFail($id);

        $ubicacionesDis = Tarea::ubicacionesTodos($id);
        $ubicacionesOcu = Tarea::ubicacionesOcupadas($id);

        return view('tareas/tareaProgramadas/resolver', ['tarea'=>$tareaProgramadas,'ubicacionesDis'=> $ubicacionesDis, 'ubicacionesOcu'=> $ubicacionesOcu]);
    }

    public function storeResolver(TareaProgramasResolverRequest $Request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        // DB::select("call pa_eficacia_actualizarTarea(".$tarea->fechaFinSolucion.", ".$tarea->empleado_id.", 0 );");


        $fechaInicio = trim(\Request::input('fechaInicioSolucion'));
        $fechaFin = trim(\Request::input('fechaFinSolucion'));
        
        // convertimos a fecha
        $fechaInicio = $tarea->cambiarFormatoDB($fechaInicio);
        $tarea->fechaInicioSolucion = $fechaInicio;

        // convertimos a fecha
        $fechaFin = $tarea->cambiarFormatoDB($fechaFin);
        $tarea->fechaFinSolucion = $fechaFin;

        $horaReal = $tarea->obtenerHora(trim(\Request::input('hora')), trim(\Request::input('minuto')));


        $tarea->tiempoSolucion = $horaReal[0].':'.$horaReal[1];
        $tarea->estado = trim(\Request::input('estado'));
        $tarea->observaciones = trim(\Request::input('observaciones'));
        $tarea->save();

        //  salvando tareas por localizacion
        $localizaciones = $Request->input('prov', []);
        DB::table('tarea_realizadas')->where('tarea_id', '=', $id)->delete();

        for ($i = 0; $i < count($localizaciones); $i++) {
            DB::table('tarea_realizadas')->insert(
                        ['tarea_id' => $id, 'localizacion_id' => $localizaciones[$i] ]
            );
        }

        // if($tarea->estado == 3){
        // 	DB::select("call pa_eficacia_actualizarTarea(".$tarea->fechaFinSolucion.", ".$tarea->empleado_id.", 1 );");
        // }

        return redirect('tareas/tareaProgramadas')->with('message', 'El tarea Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
    }

    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        Tarea::destroy($id);

        return redirect('tareas/tareaProgramadas')->with('message', 'La tarea se elimino correctamente.');
    }

    public function cancelarSolucion($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->estado = 2;
        $tarea->save();

        // DB::select("call pa_eficacia_cancelarSolucionTarea(".$tarea->fechaFinSolucion.", '".$tarea->empleado_id."');");

        return redirect()->back()->with('message', 'Se cancelo la tarea '.$id.' correctamente.');
    }
}
