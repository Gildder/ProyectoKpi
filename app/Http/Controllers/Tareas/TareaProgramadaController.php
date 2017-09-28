<?php

namespace ProyectoKpi\Http\Controllers\Tareas;

use function array_push;
use function date_add;
use DateTime;
use Httpful\Response;
use Illuminate\Support\Facades\Session;
use ProyectoKpi\Cms\Clases\Caches;
use ProyectoKpi\Cms\Repositories\ConfiguracionRepositorio;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Http\Requests\Tareas\TareaProgramasFormRequest;
use ProyectoKpi\Http\Requests\Tareas\TareaProgramasResolverRequest;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use function redirect;
use function strtotime;
use function strval;
use Symfony\Component\HttpFoundation\Cookie;
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
        $tareas = Tarea::getTodasTareaSemana(0);
        $semanas = array_pop($tareas);

        Caches::guardar('botones', 0);

        // limpiamos el cache la variable proxSemana para trabajar con la semana actual
        Caches::borrar('proxSemana');

        return view('tareas/tareaProgramadas/index', ['tareas'=> $tareas, 'semanas'=> $semanas, 'agenda' => 0]);
    }

    public function archivadas()
    {
        $tareas = TareaRepository::getTareasArchivados();
        $semanas = array_pop($tareas);

        Caches::guardar('botones', 1);


        return view('tareas/tareaProgramadas/archivadas', ['tareas'=> $tareas, 'semanas' => $semanas]);
    }

    public function agendadas()
    {
        $tareas = TareaRepository::getTareasAgendadas();
        $semanas = array_pop($tareas);

        return view('tareas/tareaProgramadas/agendadas', ['tareas'=> $tareas, 'semanas' => $semanas, 'agenda' => 1]);
    }

    public function show($id)
    {
        $tareas = Tarea::getTarea($id);

//        dd($tareas, $id);

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

    public function store(TareaProgramasFormRequest $request)
    {
        $result = Tarea::guardar($request);
        if ($result['success']) {
            return redirect()->back()
                ->with('message', $result['message'])
                ;

        } else {
            return redirect()->to($this->getRedirectUrl())
                ->withErrors($result['message'])
                ->withInput()
                ;
        }
    }

    /* Tarea de comunes para response de Ajax */
    public function fechaInicioFinSemamal(Request $request)
    {
        $fecha = \Calcana::cambiarFormatoDB($request->fecha);
        $semanas =  \DB::select('call pa_obtenerFechaSemanaAnual(\''.$fecha.'\');');

        return [
            'semanas' => $semanas[0]
        ];
    }

    public function createnext()
    {
        Caches::guardar('proxSemana', 1);

        $semanas = TareaRepository::getSemanasTareas(date(date('Y-m-d', strtotime('now +7 day'))));

        return view('tareas.tareaProgramadas.create_next', ['semanas'=> $semanas]);
    }
    
    public function edit($id)
    {
        $tarea = Tarea::findTarea($id);
        $semanas = array_pop($tarea);
//        dd($semanas);
        $estados = TareaRepository::getEstadosEditar();

        return view('tareas.tareaProgramadas.edit', ['tarea'=> $tarea[0], 'semanas'=>$semanas, 'agendar'=> 0, 'estados'=>$estados]);
        /*
        return [
            'tarea' => $tarea,
            'estados' => $estados
        ];*/
    }

    public function update(TareaProgramasFormRequest $request, $id)
    {
//        dd($request);
        $result = Tarea::actualizar($request, $id);
        if ($result['success']) {
            return redirect('tareas/tareaProgramadas')
                ->with('message', $result['message']);

        } else {
            return redirect()->to($this->getRedirectUrl())
                ->withErrors($result['message'])
                ->withInput()
                ;
        }
    }



    public function resolver($id)
    {
        $tareaProgramadas = Tarea::findTarea($id);

        $ubicacionesDis = Tarea::ubicacionesTodos($id);

        $semanas = array_pop($tareaProgramadas);

//        dd($tareaProgramadas);

        return view('tareas/tareaProgramadas/resolver', ['tarea'=>$tareaProgramadas[0],'ubicaciones'=> $ubicacionesDis, 'agendar'=> 0, 'semanas' => $semanas]);
    }

    public function storeResolver(TareaProgramasResolverRequest $request, $id)
    {
        $result = Tarea::resolver($request, $id);
        if ($result['success']) {
            return redirect('tareas/tareaProgramadas')
                ->with('message', $result['message']);

        } else {
            return redirect()->to($this->getRedirectUrl())
                ->withErrors($result['message'])
                ->withInput()
                ;
        }
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
        $estado = Tarea::getDiaLimiteEliminar();
        return $estado;
    }


    public function getSemanaAnio(Request $request)
    {
        $tarea = Tarea::obtenerSemanaDelAnio($request->agenda);

        return [
            'tarea' => $tarea
        ];
    }
}
