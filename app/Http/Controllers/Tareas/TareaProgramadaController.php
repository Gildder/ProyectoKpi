<?php

namespace ProyectoKpi\Http\Controllers\Tareas;

use function array_push;
use function date_add;
use DateTime;
use ProyectoKpi\Cms\Clases\Caches;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Http\Requests\Tareas\TareaProgramasFormRequest;
use ProyectoKpi\Http\Requests\Tareas\TareaProgramasResolverRequest;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use function redirect;
use function strtotime;
use function strval;
use const true;

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

        // guardamos en cache las fechas de la semana
        // las semanas dentran mes, semana, fechaInicio, fechaFin
        Caches::guardar('semanas', $semanas);


        Caches::guardar('botones', 0);

        // limpiamos el cache la variable proxSemana para trabajar con la semana actual
        Caches::borrar('proxSemana');


        return view('tareas/tareaProgramadas/index', ['tareas'=> $tareas, 'semanas'=> $semanas]);
    }

    public function archivados()
    {
        $tareas = TareaRepository::getTareasArchivados();

        // guardamos en cache la semana
        Caches::guardar('botones', 1);


        return view('tareas/tareaProgramadas/archivados', ['tareas'=> $tareas]);
    }

    public function eliminados()
    {
        return view('tareas/tareaProgramadas/eliminados');
    }

    public function create()
    {
        // guardamos la cache de tipo de semana
        Caches::guardar('proxSemana', 0);

        return view('tareas.tareaProgramadas.create');
    }

    public function store(TareaProgramasFormRequest $Request)
    {
        $tarea = new Tarea;
        $tarea->numero = $tarea->getNumero();
        $tarea->descripcion = trim(\Request::input('descripcion'));
        $tarea->fechaInicioEstimado = $tarea->validarFechaInicioEstimacion(\Request::input('fechaInicioEstimado'));
        $tarea->fechaFinEstimado = $tarea->validarFechaFinEstimacion(\Request::input('fechaFinEstimado'));
        $horaReal = $tarea->obtenerHora(trim(\Request::input('hora')), trim(\Request::input('minuto')));
        $tarea->tiempoEstimado = $horaReal[0].':'.$horaReal[1];
        $tarea->tipoTarea_id = '1';
        $tarea->estadoTarea_id = '1';
        $tarea->user_id = \Usuario::get('id');

        // valimidamos los limite de las fecha de inicio y fin de semana
        if(!$tarea->validarLimiteFechas()){
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('Las fechas estan fuera del rango permitido.')
                ->withInput();
        }

        if ($tarea->save()) {
            return redirect('tareas/tareaProgramadas')
                    ->with('message', 'La nueva tarea se guardo correctamente');
        } else {
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('La tarea NO se guardo, por favor verifique los campos')
                ->withInput();
        }
    }

    public function createnext()
    {
        Caches::guardar('proxSemana', 1);

        $semanas = TareaRepository::getSemanasTareas(date(date('Y-m-d', strtotime('now +6 day'))));

        return view('tareas.tareaProgramadas.create_next', ['semanas'=> $semanas]);
    }
    
    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);

        return view('tareas/tareaProgramadas/edit', ['tarea'=>$tarea]);
    }

    public function update(TareaProgramasFormRequest $Request, $id)
    {
//        dd(date('Y-m-d'));
        $tarea = Tarea::findOrFail($id);
        $tarea->descripcion = trim(\Request::input('descripcion'));
        $tarea->estadoTarea_id = trim(\Request::input('estado'));
        $tarea->fechaInicioEstimado = $tarea->validarFechaInicioEstimacion(\Request::input('fechaInicioEstimado'));
        $tarea->fechaFinEstimado = $tarea->validarFechaFinEstimacion(\Request::input('fechaFinEstimado'));
        $horaReal = $tarea->obtenerHora(trim(\Request::input('hora')), trim(\Request::input('minuto')));
        $tarea->tiempoEstimado = $horaReal[0].':'.$horaReal[1];

        if(!$tarea->validarLimiteFechas() ){
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('Las fechas estan fuera del rango permitido.')
                ->withInput();
        }

        $tarea->save();

        return redirect('tareas/tareaProgramadas')
            ->with('message', 'La tarea Nro. '.$tarea->nro.' se actualizo correctamente');

    }

    public function show($id)
    {
        $tareas = Tarea::findOrFail($id);

        return view('tareas/tareaProgramadas/show', ['tarea'=>$tareas]);
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
        $tarea->fechaInicioSolucion = $tarea->validarFechaInicioEstimacion(\Request::input('fechaInicioSolucion'));
        $tarea->fechaFinSolucion =  $tarea->validarFechaFinEstimacion(\Request::input('fechaFinSolucion'));

        if(! $tarea->validarLimiteFechaSolucion() ){
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('Las fechas estan fuera del rango permitido.')
                ->withInput();
        }

        $horaReal = $tarea->obtenerHora(trim(\Request::input('hora')), trim(\Request::input('minuto')));
        $tarea->tiempoSolucion = $horaReal[0].':'.$horaReal[1];
        $tarea->estadoTarea_id = 3;
        $tarea->observaciones = trim(\Request::input('observaciones'));
        $tarea->save();

        //  guardamos la localizacion de la tarea
        $localizaciones = $Request->input('prov', []);
        DB::table('tarea_localizacion')->where('tarea_id', '=', $id)->delete();

        for ($i = 0; $i < count($localizaciones); $i++) {
            DB::table('tarea_localizacion')->insert(
                ['tarea_id' => $id, 'localizacion_id' => $localizaciones[$i] ]
            );
        }


        return redirect('tareas/tareaProgramadas')
            ->with('message', 'La tarea Nro. '.$tarea->numero.' se finalizò correctamente');

    }

    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        Tarea::destroy($id);

        return redirect('tareas/tareaProgramadas')->with('message', 'La tarea se eliminò correctamente.');
    }

    public function cancelarSolucion($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->estadoTarea_id = 2;

        if ($tarea->save()) {
            return redirect()->back()->with('message', 'La tarea '.$tarea->numero.' se cambio al estado en proceso');
        } else {
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('La tarea Nro. '.$tarea->numero.' NO se cancelò, por favor verifique los campos')
                ->withInput();
        }
    }


    //verificar el estado de las tareas
    public function obtenerEstadoBtnEliminarTarea()
    {
        $estado = TareaRepository::getDiaLimiteEliminar();
        return $estado;
    }
}
