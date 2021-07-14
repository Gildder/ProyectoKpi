<?php

namespace ProyectoKpi\Http\Controllers\Tareas;

use function array_push;
use function date_add;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use ProyectoKpi\Cms\Clases\Caches;
use ProyectoKpi\Cms\Semanas\SemanaTarea;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests\Tareas\TareaProgramasFormAgendaRequest;
use ProyectoKpi\Models\Localizaciones\Localizacion;
use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Http\Requests\Tareas\TareaProgramasFormRequest;
use ProyectoKpi\Http\Requests\Tareas\TareaProgramasResolverRequest;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use function redirect;
use function strtotime;

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
        $semana = new SemanaTarea();
        $tareas = Tarea::getTareaDeLaSemana($semana);

        Caches::guardar('inicioSemana', $semana->getSemana()->fechaInicio);
        Caches::guardar('finSemana', $semana->getSemana()->fechaFin);
        // utilizamos esta variable para boton de volver de show
        Caches::guardar('tipoAgenda', 0);


        return view('tareas/tareaProgramadas/index', [
            'tareas'=> $tareas,
            'semanas'=> $semana->getSemana(),
            'agenda' => 0
        ]);
    }

    public function archivadas()
    {
        $semana = new SemanaTarea();
//        $tareas = Tarea::getTareasArchivados($semana);

        // utilizamos esta variable para boton de volver de show
        Caches::guardar('tipoAgenda', 1);

        return view('tareas/tareaProgramadas/archivadas', [
            'semanas' => $semana->getSemana(),
            'estados'=> Tarea::getEstados(),
            'localizaciones'=>  Localizacion::getLocalizaciones(),
            'agenda' => 1
        ]);
    }

    public function agendadas()
    {
        $semana = new SemanaTarea();
        $tareas = Tarea::getTareasAgendadas($semana->getSemanaSigte());
        // utilizamos esta variable para boton de volver de show
        Caches::guardar('tipoAgenda', 2);

        return view('tareas/tareaProgramadas/agendadas', [
            'tareas'=> $tareas,
            'semanas' => $semana->getSemana(),
            'agenda' => 2
        ]);
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

    public function store(TareaProgramasFormRequest $request)
    {
        $resultado = Tarea::validarTarea($request);

        if($resultado['success'])
        {
            $result = Tarea::guardar($request);

            if ($result['success']) {
                return redirect()->back()
                    ->with('message', $result['message']);

            } else {
                return redirect()->to($this->getRedirectUrl())
                    ->withErrors($result['message'])
                    ->withInput();
            }
        }else{
            return $resultado;
        }
    }

    public function resolver($id)
    {
        $tareaProgramadas = Tarea::findTarea($id);

        $ubicacionesDis = Tarea::ubicacionesTodos($id);

        $semanas = new SemanaTarea();

        return view('tareas/tareaProgramadas/resolver', ['tarea'=>$tareaProgramadas,'ubicaciones'=> $ubicacionesDis, 'agendar'=> 0, 'semanas' => $semanas->getSemana()]);
    }

    public function storeResolver(TareaProgramasResolverRequest $request, $id)
    {
        $resultado = Tarea::validarTarea($request);


        if ($resultado['success']) {

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

        } else {
            return redirect()->to($this->getRedirectUrl())
                ->withErrors($resultado['message'])
                ->withInput()
                ;
        }
    }

    public function update(TareaProgramasFormRequest $request, $id)
    {
        $resultado = Tarea::validarTarea($request);

        if($resultado['success'])
        {
            $result = Tarea::actualizar($request, $id);
            if ($result['success']) {
                $url = \Calcana::getHrefIndex();

                return redirect($url)
                    ->with('message', $result['message']);

            } else {
                return redirect()->to($this->getRedirectUrl())
                    ->withErrors($result['message'])
                    ->withInput()
                    ;
            }
        }else{
            return redirect()->to($this->getRedirectUrl())
                ->withErrors($resultado['message'])
                ->withInput();
        }
    }

    public function storeAgenda(TareaProgramasFormAgendaRequest $request)
    {
        $result = Tarea::guardarAgenda($request);
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
        $semanas = new SemanaTarea();
        $tarea = Tarea::findTarea($id);
        $estados = TareaRepository::getEstadosEditar();

        return view('tareas.tareaProgramadas.edit', ['tarea'=> $tarea, 'semanas'=>$semanas->getSemana(), 'agendar'=> 0, 'estados'=>$estados]);
    }

    public function destroy($id)
    {
        Tarea::destroy($id);

        return redirect('tareas/tareaProgramadas')->with('message', 'La tarea se eliminò correctamente.');
    }

    public function eliminarTareaAjax(Request $request)
    {
        try {
            Tarea::destroy($request->id);

            return response()->json(['success' => true, 'message' => 'La tarea se elimino correctamente']);
        }catch(Exception $ex ){
            return response()->json(['success' => false, 'message' => 'No se elimino tarea, consulte al administrador']);

        }
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


    /**
     * Devuelve los datos de la semana actual del Año
     * Solemente ocupar la actualizar el cache del a semana de registro de la Tarea
     *
     * @param Request $request
     * @return array
     */
    public function getSemanaAnioFecha(Request $request)
    {
        $semana = new SemanaTarea();
        $result = $semana->buscarSemana($request->fecha);

        // Cacheamos la semana habilitada para registrar tareas
        Caches::guardar('inicioSemana', \Calcana::cambiarFormatoDB($result->fechaInicio));
        Caches::guardar('finSemana', \Calcana::cambiarFormatoDB($result->fechaFin));

        return [
            'tarea' => $result
        ];
    }

    public function buscarArchivadas(Request $request)
    {

        $semana = new SemanaTarea();
        $resultado = Tarea::validarVacio($request);

        if(!$resultado['success']){
            $tareas= Tarea::filtrarTareas($request);
        }else{
            $tareas = Tarea::getTareasArchivados($semana);
        }

        if($tareas['success']){
            \Cache::forget('tareasSupervisadas');
            \Cache::forever('tareasSupervisadas', $tareas['tareas']);
        }

        return redirect()->to($this->getRedirectUrl())
            ->withInput();
    }

    public function tareaSemanaJson()
    {
        $semana = new SemanaTarea();
        return Tarea::getTareaDeLaSemanaJson($semana);
    }

    public function tareaArchivadasJson()
    {
        $semana = new SemanaTarea();
//        return Tarea::getTareasArchivadosJson($semana);
        $tarea = \Cache::get('tareasSupervisadas');
        return response()->json($tarea);
    }

    public function getAgendadasJson()
    {
        $semana = new SemanaTarea();
        $semanas = $semana->getSemanaSigte();

        return Tarea::getTareasAgendadasJson($semanas);
    }
}
