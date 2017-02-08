<?php

namespace ProyectoKpi\Http\Controllers\Tareas;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use  Illuminate\Database\Eloquent\Collection;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Models\Localizaciones\Localizacion;
use ProyectoKpi\Http\Requests\Tareas\TareaDiariaFormRequest;
use ProyectoKpi\Http\Requests\Tareas\TareaDiariasResolverRequest;


class TareaDiariaController extends Controller
{
    // protected $tareaDiaria;
    
    // public function __contruct(CargoRepository $tareaDiaria)
   	// {
   	// 	//$this->middleware('is_route');
   	// 	$this->tareaDiaria = $tareaDiaria;
   	// }


    public function index()
	{	

		$user = Auth::user();  //obtenemos el usuario logueado

		$tareas = Tarea::where('tipo','=', '2')->where('empleado_id', $user->empleado->codigo )->get();

		return view('tareas/tareaDiaria/index', ['tareas'=> $tareas]);
	}

	public function create()
	{

		return view('tareas.tareaDiaria.create');
	}

	public function store(TareaDiariaFormRequest $Request)
	{
		$user = Auth::user();  //obtenemos el usuario logueado
		$tarea = new Tarea;
		$tarea->descripcion = trim(\Request::input('descripcion'));
		$tarea->tipo = '2';
		$tarea->empleado_id = $user->empleado->codigo;
		$tarea->save();

		return redirect('tareas.tareaDiaria.index')->with('message', 'El tarea "'.$tarea->descripcion.'" se guardo correctamente.');
	}

	
	public function edit($id)
	{
		$tarea = Tarea::findOrFail($id);
		
		return view('tareas/tareaDiaria/edit',['tarea'=>$tarea]);

	}

	public function update(TareaProgramasFormRequest $Request, $id)
	{
		$tarea = Tarea::findOrFail($id);
		$tarea->descripcion = trim(\Request::input('descripcion'));
		$tarea->save();

		return redirect('tareas/tareaDiaria')->with('message',  'El tarea Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function show($id)
	{
		$tareaDiaria = Tarea::findOrFail($id);

		return view('tareas/tareaDiaria/show', ['tarea'=>$tareaDiaria]);
	}


	public function resolver($id)
	{

		$tareaDiaria = Tarea::findOrFail($id);

		$ubicacionesDis = Tarea::ubicacionesDisponibles($id);
		$ubicacionesOcu = Tarea::ubicacionesOcupadas($id);

				
		return view('tareas/tareaDiaria/resolver', ['tarea'=>$tareaDiaria,'ubicacionesDis'=> $ubicacionesDis, 'ubicacionesOcu'=> $ubicacionesOcu]);
	}	

	public function storeResolver(TareaDiariasResolverRequest $Request,$id)
	{

		$tarea = Tarea::findOrFail($id);
		$tarea->fechaInicioSolucion = trim(\Request::input('fechaInicioSolucion'));
		$tarea->fechaFinSolucion = trim(\Request::input('fechaFinSolucion'));
		$tarea->estado = trim(\Request::input('estado'));
		$tarea->tiempoSolucion = trim(\Request::input('tiempoSolucion'));
		$tarea->observaciones = trim(\Request::input('observaciones'));
		$tarea->save();

		return redirect('tareas/tareaDiaria')->with('message',  'El tarea Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
	}

	public function destroy($id)
	{
		Tarea::destroy($id);

		return redirect('tareas/tareaDiaria')->with('message',  'El tarea de Nro.- '.$id.'  se elimino correctamente.');
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
