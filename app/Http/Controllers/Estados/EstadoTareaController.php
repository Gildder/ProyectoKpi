<?php

namespace ProyectoKpi\Http\Controllers\Estados;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Http\Requests\Estados\EstadoTareaFormRequest;
use ProyectoKpi\Models\Tareas\Estados;

class EstadoTareaController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('estados/tareas/index', ['estados'=> Estados::all()]);
    }


    public function create()
    {
        return view('estados.tareas.create');
    }

    public function store(EstadoTareaFormRequest $Request)
    {
        $estado = new Estados();
        $estado->nombre = trim(\Request::input('nombre'));
        $estado->descripcion = trim(\Request::input('descripcion'));
        $estado->color = trim(\Request::input('color'));
        $estado->texto = trim(\Request::input('texto'));
        $estado->visibleCalendario = trim(\Request::input('visibleCalendario'));
        $estado->visibleEmpleado = trim(\Request::input('visibleEmpleado'));
        $estado->save();

        return redirect('estados/tareas')->with('message', 'Es estado se guardo correctamente.');
    }

    public function edit($id)
    {
        $estado = Estados::findOrFail($id);

        return view('estados/tareas/edit', ['estado'=>$estado]);
    }

    public function update(EstadoTareaFormRequest $request, $id)
    {
        $estado = Estados::findOrFail($id);
        $estado->nombre = trim($request->nombre);
        $estado->descripcion = trim($request->descripcion);
        $estado->color = $request->color;
        $estado->texto = $request->texto;
        $estado->visibleCalendario =$request->visibleCalendario;
        $estado->visibleEmpleado = $request->visibleEmpleado;
        $estado->save();

        return redirect('estados/tareas')->with('message', 'El estado se actualizo correctamente.');
    }

    public function show($id)
    {
        $estado = Estados::findOrFail($id);

        return view('estados/tareas/show', ['estado'=>$estado]);
    }

    public function destroy($id)
    {
        Estados::destroy($id);

        return redirect('estados/tareas')->with('message', 'El estado se elimino correctamente.');
    }

    public function eliminados()
    {
        $estados = Estados::onlyTrashed()->get();

        return view('estados/tareas/eliminados', ['estados'=> $estados]);
    }

    public function restaurar($id)
    {
        $estado = Estados::withTrashed()
            ->where('id', $id)
            ->restore();

        return redirect()->back()->with('message', 'Se restauro el estado correctamente.');
    }
}
