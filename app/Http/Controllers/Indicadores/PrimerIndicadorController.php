<?php

namespace ProyectoKpi\Http\Controllers\Indicadores;

use Illuminate\Http\Request;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;

use ProyectoKpi\Models\Indicadores\Indicador;

class PrimerIndicadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $indicadores = Indicador::select('indicadores.id', 'indicadores.orden', 'indicadores.nombre', 'indicadores.descripcion_objetivo', 'indicadores.objetivo', 'tipos_indicadores.nombre as tipo', 'indicadores.condicion', 'frecuencias.nombre as frecuencia')
                                ->join('frecuencias', 'frecuencias.id', '=', 'indicadores.frecuencia_id')
                                ->join('tipos_indicadores', 'tipos_indicadores.id', '=', 'indicadores.tipo_indicador_id')
                                ->where('indicadores.estado', '=', '1')->get();

        return view('indicadores/primerindicador/index')->with('indicadores', $indicadores);
    }



    public function create()
    {
        return "metodo create";
    }

    public function store()
    {
        return "metodo store";
    }

    public function show($id)
    {
        return "metodo show ".$id;
    }

    public function update($id)
    {
        return "metodo update ".$id;
    }

    public function destroy($id)
    {
        return "metodo destroy ".$id;
    }
}
