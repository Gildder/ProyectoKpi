<?php

namespace ProyectoKpi\Http\Controllers\Evaluadores;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Http\Requests\Evaluadores\EscalaFormRequest;

use ProyectoKpi\Models\Evaluadores\Escala;

class EscalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('evaluadores.escala.index', ['escalas'=>Escala::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evaluadores.escala.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EscalaFormRequest $request)
    {
        $escala = new Escala;
        $escala->nombre = trim(\Request::input('nombre'));
        $escala->save();

        return redirect('evaluadores/escala')->with('message', 'La escala "'.$escala->nombre.'" se guardo correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $escala = Escala::findOrFail($id);
                
        return view('evaluadores.escala.show', ['escala'=>$escala]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $escala = Escala::findOrFail($id);
        
        return view('evaluadores.escala.edit', ['escala'=>$escala]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EscalaFormRequest $request, $id)
    {
        $escala = Escala::findOrFail($id);
        $escala->nombre = trim(\Request::input('nombre'));
        $escala->save();

        return redirect('evaluadores/escala')->with('message', 'La escala Nro. '.$id.' - '.$request->nombre.' se actualizo correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Escala::destroy($id);

        return redirect('evaluadores/escala')->with('message', 'La escala de Nro.- '.$id.'  se elimino correctamente.');
    }
}
