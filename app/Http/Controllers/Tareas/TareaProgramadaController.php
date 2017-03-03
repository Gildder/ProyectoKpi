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


class TareaProgramadaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
	{	
		$user = Auth::user();  //obtenemos el usuario logueado
		$tareas = Tarea::where('tipo','=', '1')->where('empleado_id', $user->empleado->codigo )->get();

		// var_dump($semanas); 
		// var_dump($tareas);

		return view('tareas/tareaProgramadas/index', ['tareas'=> $tareas]);
	}

	public function create()
	{
		$semanas = Tarea::listSemana(date('Y-m-d'));

		return view('tareas.tareaProgramadas.create', ['semanas'=>$semanas]);
	}

	public function store(TareaProgramasFormRequest $Request)
	{
		$user = Auth::user();  //obtenemos el usuario logueado
		$tarea = new Tarea;
		$tarea->descripcion = trim(\Request::input('descripcion'));
		$tarea->fechaInicioEstimado = trim(\Request::input('fechaInicioEstimado'));
		$tarea->fechaFinEstimado = trim(\Request::input('fechaFinEstimado'));
		$tarea->tiempoEstimado = trim(\Request::input('hora')).':'.trim(\Request::input('minuto'));
		$tarea->tipo = '1';
		$tarea->empleado_id = $user->empleado->codigo;
		$tarea->save();


		return redirect('tareas/tareaProgramadas')->with('message', 'El tarea "'.$tarea->descripcion.'" se guardo correctamente.');
	}

	
	public function edit($id)
	{
		$tarea = Tarea::findOrFail($id);
		$semanas = Tarea::listSemana($tarea->fechaInicioEstimado);
		
		return view('tareas/tareaProgramadas/edit',['tarea'=>$tarea, 'semanas'=>$semanas]);

	}

	public function update(TareaProgramasFormRequest $Request, $id)
	{
		$tarea = Tarea::findOrFail($id);
		$tarea->descripcion = trim(\Request::input('descripcion'));
		$tarea->fechaInicioEstimado = trim(\Request::input('fechaInicioEstimado'));
		$tarea->fechaFinEstimado = trim(\Request::input('fechaFinEstimado'));
		$tarea->tiempoEstimado = trim(\Request::input('tiempoEstimado'));
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

		$ubicacionesDis = Tarea::ubicacionesDisponibles($id);
		$ubicacionesOcu = Tarea::ubicacionesOcupadas($id);

				
		return view('tareas/tareaProgramadas/resolver', ['tarea'=>$tareaProgramadas,'ubicacionesDis'=> $ubicacionesDis, 'ubicacionesOcu'=> $ubicacionesOcu]);
	}	

	public function storeResolver(TareaProgramasResolverRequest $Request,$id)
	{

		$tarea = Tarea::findOrFail($id);
		$tarea->fechaInicioSolucion = trim(\Request::input('fechaInicioSolucion'));
		$tarea->fechaFinSolucion = trim(\Request::input('fechaFinSolucion'));
		$tarea->estado = trim(\Request::input('estado'));
		$tarea->tiempoSolucion = trim(\Request::input('tiempoSolucion'));
		$tarea->observaciones = trim(\Request::input('observaciones'));
		$tarea->save();

		return redirect('tareas/tareaProgramadas')->with('message',  'El tarea Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function destroy($id)
	{
		Tarea::destroy($id);

		return redirect('tareas/tareaProgramadas')->with('message',  'El tarea de Nro.- '.$id.'  se elimino correctamente.');
	}


	public function agregarubicacion($tarea_id, $ubi_id)
    {
        DB::table('tarea_realizadas')->insert(
            array('tarea_id' => $tarea_id, 'localizacion_id' => $ubi_id)
        );

        return $this->resolver($tarea_id);
    }

    public function quitarubicacion($tarea_id, $ubi_id)
    {
        DB::table('tarea_realizadas')->where('tarea_id', $tarea_id)->where('localizacion_id', $ubi_id)->delete();

        return $this->resolver($tarea_id);
    }
}
