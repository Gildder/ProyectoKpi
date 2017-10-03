<?php

namespace ProyectoKpi\Http\Controllers\Localizaciones;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use ProyectoKpi\Models\Localizaciones\GrupoLocalizacion;
use ProyectoKpi\Models\Localizaciones\Localizacion;
use ProyectoKpi\Http\Requests\Localizaciones\LocalizacionFormRequest;
use ProyectoKpi\Http\Requests\Localizaciones\LocalizacionRequestUpdate;

class LocalizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //
    public function index()
    {
        $localizaciones = Localizacion::getLocalizaciones();

        dd($localizaciones);


        return view('localizaciones/localizacion/index')->with('localizaciones', $localizaciones);
    }


    public function create()
    {
        $grupo = GrupoLocalizacion::all();

        return view('localizaciones.localizacion.create', ['grupo'=>$grupo]);
    }

    public function store(LocalizacionFormRequest $Request)
    {
        $localizacion = new Localizacion;
        $localizacion->nombre = trim(\Request::input('nombre'));
        $localizacion->direccion = trim(\Request::input('direccion'));
        $localizacion->telefono = trim(\Request::input('telefono'));
        $localizacion->grupoloc_id = $Request->grupoloc_id;
        $localizacion->save();

        return redirect('localizaciones/localizacion')->with('message', 'La Localizacion "'.$localizacion->nombre.'" se guardo correctamente.');
    }

    public function edit($id)
    {
        $localizacion = Localizacion::findOrFail($id);
        $grupo = GrupoLocalizacion::all();


        return view('localizaciones.localizacion.edit', ['localizacion'=>$localizacion,'grupo'=>$grupo]);
    }

    public function update(LocalizacionFormRequest $Request, $id)
    {
        $localizacion = Localizacion::findOrFail($id);
        $localizacion->nombre = trim(\Request::input('nombre'));
        $localizacion->direccion = trim(\Request::input('direccion'));
        $localizacion->telefono = trim(\Request::input('telefono'));
        $localizacion->grupoloc_id = $Request->grupoloc_id;
        $localizacion->save();

        return redirect('localizaciones/localizacion')->with('message', 'La Localizacion Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
    }

    public function show($id)
    {
        $localizacion = Localizacion::findOrFail($id);
        return response()->json($localizacion);
    }

    public function destroy($id)
    {
        Localizacion::destroy($id);

        return redirect('localizaciones/localizacion')->with('message', 'La Localizacion de Nro.- '.$id.'  se elimino correctamente.');
    }

    public function eliminados()
    {
        $localizaciones = Localizacion::onlyTrashed()->get();
        
        return view('localizaciones/localizacion/eliminados', ['localizaciones'=> $localizaciones]);
    }
    
    public function restaurar($id)
    {
        $localizacion = Localizacion::withTrashed()
        ->where('id', $id)
        ->restore();

        return redirect()->back()->with('message', 'La localizacion '.$id.' se restauro correctamente.');
    }
}
