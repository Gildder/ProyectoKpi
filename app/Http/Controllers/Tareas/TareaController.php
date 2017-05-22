<?php

namespace ProyectoKpi\Http\Controllers\Tareas;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;

class TareaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('tareas/tarea/index', ['tareas'=> tarea::all()]);
    }

    public function create()
    {
        return view('tareas.tarea.create');
    }

    public function store(TareaFormRequest $Request)
    {
        $tarea = new Tarea;
        $tarea->nombre = trim(\Request::input('nombre'));
        $tarea->fechaInicio = trim(\Request::input('fechaInicio'));
        $tarea->fechaFin = trim(\Request::input('fechaFin'));
        $tarea->save();

        return redirect()->back()->with('message', 'El tarea "'.$tarea->nombre.'" se guardo correctamente.');
    }

    
    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);
        
        return view('tareas/tarea/edit', ['tarea'=>$tarea]);
    }

    public function update(TareaFormRequest $Request, $id)
    {
        $tarea = tarea::findOrFail($id);
        $tarea->nombre = trim(\Request::input('nombre'));
        $tarea->fechaInicio = trim(\Request::input('fechaInicio'));
        $tarea->fechaFin = trim(\Request::input('fechaFin'));
        $tarea->save();

        return redirect()->back()->with('message', 'El tarea Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
    }

    public function show($id)
    {
        $tarea = tarea::findOrFail($id);
                
        return view('tareas/tarea/show', ['tarea'=>$proyecto]);
    }

    public function destroy($id)
    {
        Cargo::destroy($id);

        return redirect('tareas/tarea')->with('message', 'El tarea de Nro.- '.$id.'  se elimino correctamente.');
    }
}
