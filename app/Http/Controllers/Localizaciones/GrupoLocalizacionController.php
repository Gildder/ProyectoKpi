<?php

namespace ProyectoKpi\Http\Controllers\Localizaciones;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use ProyectoKpi\Models\Localizaciones\GrupoLocalizacion;
use ProyectoKpi\Http\Requests\Localizaciones\GrupoLocalizacionFormRequest;
use ProyectoKpi\Http\Requests\Localizaciones\GrupoLocalizacionRequestUpdate;

class GrupoLocalizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $grupolocalizaciones = GrupoLocalizacion::all();

        return view('localizaciones/grupolocalizacion/index')->with('grupolocalizaciones', $grupolocalizaciones);
    }

    public function create()
    {
        return view('localizaciones.grupolocalizacion.create');
    }

    public function store(GrupoLocalizacionFormRequest $Request)
    {
        $grupolocalizacion = new GrupoLocalizacion;
        $grupolocalizacion->nombre = trim(\Request::input('nombre'));
        $grupolocalizacion->save();

        return redirect('localizaciones/grupolocalizacion')->with('message', 'El Grupo "'.$grupolocalizacion->nombre.'" se guardo correctamente.');
    }

    public function edit($id)
    {
        $grupolocalizacion = GrupoLocalizacion::findOrFail($id);
        return view('localizaciones.grupolocalizacion.edit')->with('grupolocalizacion', $grupolocalizacion);
    }

    public function update(GrupoLocalizacionFormRequest $Request, $id)
    {
        $grupolocalizacion = GrupoLocalizacion::findOrFail($id);
        $grupolocalizacion->nombre = trim(\Request::input('nombre'));
        $grupolocalizacion->save();

        return redirect('localizaciones/grupolocalizacion')->with('message', 'El Grupo Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
    }

    public function show($id)
    {
        $grupolocalizacion = GrupoLocalizacion::findOrFail($id);
        return response()->json($grupolocalizacion);
    }

    public function destroy($id)
    {
        GrupoLocalizacion::destroy($id);

        return redirect('localizaciones/grupolocalizacion')->with('message', 'El Grupo de Nro.- '.$id.'  se elimino correctamente.');
    }

    public function eliminados()
    {
        $grupolocalizaciones = GrupoLocalizacion::onlyTrashed()->get();
        
        return view('localizaciones/grupolocalizacion/eliminados', ['grupolocalizaciones'=> $grupolocalizaciones]);
    }
    
    public function restaurar($id)
    {
        GrupoLocalizacion::withTrashed()
        ->where('id', $id)
        ->restore();

        return redirect()->back()->with('message', 'El grupo localizacion '.$id.' se restauro correctamente.');
    }
}
