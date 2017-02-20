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
    protected $tareas;
    protected $semanas;


    public function __construct(TareaRepository $tareas)
    {
        $this->tareas = $tareas;
        $this->semanas = $tareas->listSemana(date('Y-m-d'));
        $this->middleware('auth');
    }


    public function index()
	{	
		$tareas = $this->tareas->getTareasProgramadas();

		return view('tareas/tareaProgramadas/index', ['tareas'=> $tareas, 'semanas'=> $this->semanas]);
	}

	public function archivados()
	{	
		$tareas = $this->tareas->getTareasArchivados();

		return view('tareas/tareaProgramadas/archivados', ['tareas'=> $tareas]);
	}

	public function eliminados()
	{	
		return view('tareas/tareaProgramadas/eliminados');
	}

	public function create()
	{
		return view('tareas.tareaProgramadas.create', [ 'semanas'=> $this->semanas]);
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
		$tarea->tipo = '1';
		$tarea->empleado_id = $user->empleado->codigo;

		if($tarea->save())
		{
			// $eventSaved = \Event::fire(new TareaSaved($tarea));

			return redirect('tareas/tareaProgramadas')->with('message', 'El tarea "'.$tarea->descripcion.'" se guardo correctamente.');
		}else{
			return back()->withInput();
		}
	}

	
	public function edit($id)
	{
		$tarea = Tarea::findOrFail($id);
		$semanas = $this->tareas->listSemana($tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado));
		
		return view('tareas/tareaProgramadas/edit',['tarea'=>$tarea, 'semanas'=>$semanas]);

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


		if($tarea->save())
		{
			// $eventSaved = \Event::fire(new TareaUpdated($tarea));

			return redirect('tareas/tareaProgramadas')->with('message',  'El tarea Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
		}else{
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

	public function storeResolver(TareaProgramasResolverRequest $Request,$id)
	{

		$tarea = Tarea::findOrFail($id);
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
		$localizaciones = $Request->input('prov',[]);
		DB::table('tarea_realizadas')->where('tarea_id', '=', $id)->delete();

		for($i = 0; $i < count($localizaciones); $i++)
		{
		    DB::table('tarea_realizadas')->insert(
				    	['tarea_id' => $id, 'localizacion_id' => $localizaciones[$i] ]
		    );
		}

		return redirect('tareas/tareaProgramadas')->with('message',  'El tarea Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function destroy($id)
	{
		Tarea::destroy($id);

		return redirect('tareas/tareaProgramadas')->with('message',  'El tarea de Nro.- '.$id.'  se elimino correctamente.');
	}



}
