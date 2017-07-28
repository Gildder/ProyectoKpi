<?php

namespace ProyectoKpi\Http\Controllers\Tareas;

use function array_push;
use function date_add;
use Illuminate\Http\Request;
use function json_encode;
use function print_r;
use ProyectoKpi\Cms\Clases\Caches;
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
use function redirect;
use function sizeof;
use function strtotime;

class TareaProgramadaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $cadena = 'No Válida';

        if (($timestamp = strtotime($cadena)) === false) {
//            print_r("La cadena ($cadena) es falsa");
            print_r(date('d/m/Y',strtotime( "   2009-02-3 +6day" )));
        } else {
            print_r( "$cadena == " . date('l dS \o\f F Y h:i:s A', $timestamp));
        }


        // obtenemos las tareas programadas
        $tareas = TareaRepository::getTareasProgramadas();
        // obtenemos la semana de tarea
        $semanas = TareaRepository::getSemanasTareas(date('Y-m-d'));

        // guardamos en cache las fechas de la semana
        // las semanas dentran mes, semana, fechaInicio, fechaFin
        Caches::guardar('semanas', $semanas);


        Caches::guardar('botones', 0);

        // limpiamos el cache la variable estasemana para trabajar con la semana actual
        Caches::borrar('estasemana');


        return view('tareas/tareaProgramadas/index', ['tareas'=> $tareas, 'semanas'=> $semanas]);
    }

    public function archivados()
    {
        $tareas = TareaRepository::getTareasArchivados();

        // guardamos en cache la semana
        TareaRepository::cachear('botones', 1);


        return view('tareas/tareaProgramadas/archivados', ['tareas'=> $tareas]);
    }

    public function eliminados()
    {
        return view('tareas/tareaProgramadas/eliminados');
    }

    public function create()
    {
        // guardamos la cache de tipo de semana
        Caches::guardar('estasemana', 0);

        return view('tareas.tareaProgramadas.create');
    }

    public function store(TareaProgramasFormRequest $Request)
    {
        // convertimos a fechas en formato base de datos
        $fechaInicio = date('Y-m-d', \Request::input('fechaInicioEstimado'));
        $fechaFin = date('Y-m-d', \Request::input('fechaFinEstimado'));

        // valimidamos los limite de las fecha de inicio y fin de semana
        $error = $this->validarLimiteFechas($fechaInicio, $fechaFin);


        if(sizeof($error)> 0 ){
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('Las fechas ingresadas son incorrectas..')
                ->withInput();
        }

        $user = Auth::user();  //obtenemos el usuario logueado
        
        $tarea = new Tarea;
        $tarea->descripcion = trim(\Request::input('descripcion'));


        $tarea->fechaInicioEstimado = $fechaInicio;


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

    public function create_next()
    {
        Caches::guardar('estasemana', 1);

        $semanas = TareaRepository::getSemanasTareas(date('Y-m-d', strtotime('6 day', strtotime(date('Y-m-d')))));

        return view('tareas.tareaProgramadas.create_next', ['semanas'=> $semanas]);
    }
    
    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);
//        dd($tarea->fechaInicioEstimado);
//        dd($semanas);
        return view('tareas/tareaProgramadas/edit', ['tarea'=>$tarea]);
    }

    public function update(TareaProgramasFormRequest $Request, $id)
    {

        $fechaInicio = trim(\Request::input('fechaInicioEstimado'));
        $fechaFin = trim(\Request::input('fechaFinEstimado'));

        // convertimos a fecha
        $fechaInicio = \Calcana::cambiarFormatoDB($fechaInicio);
        // convertimos a fecha
        $fechaFin = \Calcana::cambiarFormatoDB($fechaFin);

        $error = $this->validarLimiteFechas($fechaInicio, $fechaFin, \Request::input('estasemana'));
//        dd(\Cache::get('semanas'), $fechaInicio,$fechaFin, $error);
        if(sizeof($error)> 0 ){
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('Las fechas ingresadas son incorrectas..')
                ->withInput();
        }


        $tarea = Tarea::findOrFail($id);
        // Evento para actualizar indicador
        // $eventUpdating = \Event::fire(new TareaUpdating($tarea));


        $tarea->descripcion = trim(\Request::input('descripcion'));
        $tarea->estadoTarea_id = trim(\Request::input('estado'));

        $tarea->fechaInicioEstimado = $fechaInicio;


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
        $fechaInicio = trim(\Request::input('fechaInicioSolucion'));
        $fechaFin = trim(\Request::input('fechaFinSolucion'));

        // convertimos a fecha
        $fechaInicio = \Calcana::cambiarFormatoDB($fechaInicio);
        // convertimos a fecha
        $fechaFin = \Calcana::cambiarFormatoDB($fechaFin);

        $error = $this->validarLimiteFechas($fechaInicio, $fechaFin);
        if(sizeof($error)> 0 ){
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('Las fechas ingresadas son incorrectas..')
                ->withInput();
        }



        $tarea = Tarea::findOrFail($id);
        // DB::select("call pa_eficacia_actualizarTarea(".$tarea->fechaFinSolucion.", ".$tarea->empleado_id.", 0 );");



        $tarea->fechaInicioSolucion = $fechaInicio;


        $tarea->fechaFinSolucion = $fechaFin;

        $horaReal = $tarea->obtenerHora(trim(\Request::input('hora')), trim(\Request::input('minuto')));


        $tarea->tiempoSolucion = $horaReal[0].':'.$horaReal[1];
        $tarea->estadoTarea_id = 3;
        $tarea->observaciones = trim(\Request::input('observaciones'));
        $tarea->save();

        //  salvando tareas por localizacion
        $localizaciones = $Request->input('prov', []);
        DB::table('tarea_localizacion')->where('tarea_id', '=', $id)->delete();

        for ($i = 0; $i < count($localizaciones); $i++) {
            DB::table('tarea_localizacion')->insert(
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
        $tarea->estadoTarea_id = 2;
        $tarea->save();

        // DB::select("call pa_eficacia_cancelarSolucionTarea(".$tarea->fechaFinSolucion.", '".$tarea->empleado_id."');");

        return redirect()->back()->with('message', 'Se cancelo la tarea '.$id.' correctamente.');
    }


    private function validarLimiteFechas($fechaInicio, $fechaFin)
    {
        // obtenermos las semanas trabajadas
        if(Caches::obtener('estasemana')=== 0){
            $semanas = TareaRepository::getSemanasTareas(date('Y-m-d'));
        }else{
            $semanas = TareaRepository::getSemanasTareas(date('Y-m-d', strtotime('Y-m-d +6 day')));
        }

        $errors = array();

        if((strtotime($fechaInicio) < strtotime($semanas->fechaInicio)) || (strtotime($fechaInicio) > strtotime($semanas->fechaFin)))
        {
            array_push($errors, ['fechaInicioEstimado' => 'La fecha de inicio esta fuera del rango de la semana']);
        }

        if((strtotime($fechaFin) < strtotime($semanas->fechaInicio)) || (strtotime($fechaFin) > strtotime($semanas->fechaFin)))
        {
            array_push($errors, ['fechaFinEstimado' => 'La fecha de fin esta fuera del rango de la semana']);
        }

        return $errors;
    }


    //verificar el estado de las tareas
    public function obtenerEstadoBtnEliminarTarea()
    {
        $estado = TareaRepository::getDiaLimiteEliminar();
        return $estado;
    }
}
