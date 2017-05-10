<?php

namespace ProyectoKpi\Http\Controllers\Reportes;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;

class PdfController extends Controller
{
    public function index()
    {
    	
    }

    public function crearPdf($datos, $vistaUrl)
    {
    	$data = $datos;
    	$date = date('Y-m-d');
    	$view = \View::make($vistaUrl, compact('data', 'date'))->render();
    	$pdf = \App::make('dompdf', '');

    }

    public function crear_reportes_evaluador($evaluador, $mes)
    {
    	
    }
}
