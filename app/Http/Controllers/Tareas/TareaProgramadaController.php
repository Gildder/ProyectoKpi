<?php

namespace ProyectoKpi\Http\Controllers\Tareas;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Debugbar;
use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Models\Localizaciones\Localizacion;
use ProyectoKpi\Http\Requests\Tareas\TareaProgramasFormRequest;
use ProyectoKpi\Http\Requests\Tareas\TareaProgramasResolverRequest;
use ProyectoKpi\Cms\Repositories\TareaRepository;


class TareaProgramadaController extends Controller
{
    protected $tareas;
    public function __construct(TareaRepository $tareas)
    {
        $this->tareas = $tareas;
        $this->middleware('auth');
    }


    public function index()
	{	
		$tareas = $this->tareas->getTareasProgramadas();
        $semanas = $this->tareas->listSemana(date('Y-m-d'));
		
		return view('tareas/tareaProgramadas/index', ['tareas'=> $tareas, 'semanas'=> $semanas]);
	}

	public function archivados()
	{	
		return view('tareas/tareaProgramadas/archivados');
	}

	public function eliminados()
	{	
		return view('tareas/tareaProgramadas/eliminados');
	}

	public function create()
	{
		return view('tareas.tareaProgramadas.create');
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
		$tarea->save();


		return redirect('tareas/tareaProgramadas')->with('message', 'El tarea "'.$tarea->descripcion.'" se guardo correctamente.');
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
		$tarea->save();

		return redirect('tareas/tareaProgramadas')->with('message',  'El tarea Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
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
