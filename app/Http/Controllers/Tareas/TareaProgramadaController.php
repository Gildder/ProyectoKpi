<?php

namespace ProyectoKpi\Http\Controllers\Tareas;

use function array_push;
use function date_add;
use DateTime;
use ProyectoKpi\Cms\Clases\Caches;
use ProyectoKpi\Cms\Repositories\ConfiguracionRepositorio;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use ProyectoKpi\Models\Evaluadores\Widget;
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
        if(\Usuario::is_indicador(1))
        {
            $this->middleware('auth');
        }
    }
    
    public function index()
    {
        // obtenemos las tareas programadas
        $tareas = Tarea::getTodasTareas();
        $semanas = array_pop($tareas);

//        Caches::guardar('botones', 0);
//        Caches::guardar('diainicio', ConfiguracionRepositorio::getDiaInicio());

        // limpiamos el cache la variable proxSemana para trabajar con la semana actual
//        Caches::borrar('proxSemana');

        return view('tareas/tareaProgramadas/index', ['tareas'=> $tareas, 'semanas'=> $semanas]);
    }

    public function archivadas()
    {
        $tareas = TareaRepository::getTareasArchivados();
        $semanas = array_pop($tareas);

        // guardamos en cache la semana
//        Caches::guardar('botones', 1);

        return view('tareas/tareaProgramadas/archivadas', ['tareas'=> $tareas, 'semanas' => $semanas]);
    }

    public function agendadas()
    {
        $tareas = TareaRepository::getTareasAgendadas();
        $semanas = array_pop($tareas);


        // guardamos en cache la semana
//        Caches::guardar('botones', 1);

        return view('tareas/tareaProgramadas/agendadas', ['tareas'=> $tareas, 'semanas' => $semanas]);
    }

    public function show($id)
    {
        $tareas = Tarea::getTarea($id);

        return view('tareas/tareaProgramadas/show', ['tarea'=>$tareas]);
    }



    public function eliminados()
    {
        return view('tareas/tareaProgramadas/eliminados');
    }

    public function create()
    {
		// obtenemos la semana de tarea
		$semanas = TareaRepository::getSemanasTareas(date('Y-m-d'));

		// guardamos en cache las fechas de la semana
		// las semanas dentran mes, semana, fechaInicio, fechaFin
		Caches::guardar('semanas', $semanas);
        // guardamos la cache de tipo de semana
        Caches::guardar('proxSemana', 0);

        return view('tareas.tareaProgramadas.create');
    }

    public function store(TareaProgramasFormRequest $Request)
    {
        dd($Request->descripcion);
        $tarea = new Tarea;
//        $tarea->numero = $tarea->getMayorNumeroTarea();
        $tarea->descripcion = trim(\Request::input('descripcion'));
        $tarea->fechaInicioEstimado = $tarea->validarFechaInicioEstimacion(\Request::input('fechaInicioEstimado'), \Request::input('todasemana'));
        $tarea->fechaFinEstimado = $tarea->validarFechaFinEstimacion(\Request::input('fechaFinEstimado'), \Request::input('todasemana'));
        $horaReal = $tarea->obtenerHora(trim(\Request::input('hora')), trim(\Request::input('minuto')));
        $tarea->tiempoEstimado = $horaReal[0].':'.$horaReal[1];
        $tarea->tipoTarea_id = '1';
        $tarea->estadoTarea_id = '1';
        $tarea->user_id = \Usuario::get('id');

        $estimado = \Request::input('estimados');

        \Cache::forget('proxSemana');
        if(isset($estimado)){

            \Cache::forever('proxSemana', 1);
        }else{
            \Cache::forever('proxSemana', 0);
        }


        // validamos los limite de las fecha de inicio y fin de semana
        if(!$tarea->validarLimiteFechaEstimadas()){
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('Las fechas estan fuera del rango permitido.')
                ->withInput();
        }

        if(!$tarea->validarDuracionCeros()){
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('Las duracion de no puede ser 0')
                ->withInput();
        }

        if ($tarea->save()) {
            return redirect('tareas/tareaProgramadas')
                    ->with('message', 'Se creo la tarea Nro.'.$tarea->numero.' correctamente');
        } else {
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('La tarea NO se guardo, por favor verifique los campos')
                ->withInput();
        }
    }

    public function createnext()
    {
        Caches::guardar('proxSemana', 1);

        $semanas = TareaRepository::getSemanasTareas(date(date('Y-m-d', strtotime('now +7 day'))));

        return view('tareas.tareaProgramadas.create_next', ['semanas'=> $semanas]);
    }
    
    public function edit($id)
    {
        $tarea = Tarea::getTarea($id);
        $estados = TareaRepository::getEstadosEditar();

        return [
            'tarea' => $tarea,
            'estados' => $estados
        ];
    }

    public function update(TareaProgramasFormRequest $Request, $id)
    {
        $tarea = Tarea::findOrFail($id);

        $tarea->descripcion = trim(\Request::input('descripcion'));
        $tarea->estadoTarea_id = \Request::input('estado');
        $tarea->fechaInicioEstimado = $tarea->validarFechaInicioEstimacion(\Request::input('fechaInicioEstimado'), \Request::input('todasemana'));
        $tarea->fechaFinEstimado = $tarea->validarFechaFinEstimacion(\Request::input('fechaFinEstimado'), \Request::input('todasemana'));
        $horaReal = $tarea->obtenerHora(trim(\Request::input('hora')), trim(\Request::input('minuto')));
        $tarea->tiempoEstimado = $horaReal[0].':'.$horaReal[1].':00';
        $tarea->observaciones = trim(\Request::input('observaciones'));

        if(!$tarea->validarLimiteFechas() ){
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('Las fechas estan fuera del rango permitido.')
                ->withInput();
        }

        if($tarea->save()){
            return redirect('tareas/tareaProgramadas')
                ->with('message', 'La tarea Nro. '.$tarea->nro.' se actualizo correctamente');
        }else{
            return redirect()->back()
                ->withErrors('La tarea NO se guardo, por favor verifique los campos')
                ->withInput();
        }

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
        $tarea = Tarea::find($id);
        $tarea->fechaInicioSolucion = $tarea->validarFechaInicioEstimacion(\Request::input('fechaInicioSolucion'), null);
        $tarea->fechaFinSolucion =  $tarea->validarFechaFinEstimacion(\Request::input('fechaFinSolucion'), null);

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
        $tarea->fechaInicioSolucion = '0000-00-00';
        $tarea->fechaFinSolucion = '0000-00-00';
        $tarea->tiempoSolucion = '00:00:00';

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
