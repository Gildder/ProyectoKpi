<?php

namespace ProyectoKpi\Http\Controllers\Configuracion;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;

class ConfiguracionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cargarIndicadorEficaciaPorGerenciaEvaluadora($evaluador_id, $anio, $mes_inicio, $mes_fin)
    {

    }

    public function generarSemanasAnuales($anio)
    {

    }
}
