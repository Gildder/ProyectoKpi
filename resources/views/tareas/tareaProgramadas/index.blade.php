@extends('layouts.app')

@section('titulo')
  Tareas Programadas
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Tareas Programadas</p>
  </div>

  <div class="panel-body">

    @include('partials/alert/error')


    {{-- Opciones de Menu --}}
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <a  href="{{route('tareas.tareaProgramadas.create')}}" class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span>   <b>Nuevo</b></a>
        
      </div>
      <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6" tabindex="2" >
        {{-- Finalizado --}}
        <a  href="{{route('tareas.tareaProgramadas.archivados')}}" class="btn btn-success btn-sm" ><span class="fa  fa-archive" title="Archivados"></span><b></b></a>
        {{-- Eliminados --}}
        <a  href="{{route('tareas.tareaProgramadas.eliminados')}}" class="btn btn-danger  btn-sm" ><span class="fa fa-trash" title="Eliminados">  </span><b></b></a>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="col-sm-12" ><small>Semana {{$semanas[0]['semana']}} del mes de {{nombreMes($semanas[0]['mes'])}}, del <b>{{cambiarFormatoEuropeo($semanas[0]['fechaInicio'])}}</b> al <b>{{cambiarFormatoEuropeo($semanas[0]['fechaFin'])}}</b></small>
              </div>
          <hr/>
        @include('tareas/tareaProgramadas/partials/tabla_tareaProgramadas')
      </div>
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>
@endsection

<?php

  function cambiarFormatoEuropeo($fecha)
    {    
        $partes=explode('-',$fecha);//se parte la fecha
        $fecha=$partes[2].'/'.$partes[1].'/'.$partes[0];//se cambia para que quede formato d-m-Y
        return $fecha;
    }  

    /*
     * Metodo para cambiar del formato Y-m-d  a d-m-Y 
     * 
     * @param string $fecha
     * @return fecha en formato d-m-Y
     */
    function cambiarFormatoDB($fecha)
    {    
        $partes=explode('/',$fecha);//se parte la fecha
        $fecha=$partes[2].'-'.$partes[1].'-'.$partes[0];//se cambia para que quede formato d-m-Y

        return $fecha;
    }  


  function nombreMes($nro)
  {
    $mes = 'mes';
    switch($nro)
    {

      case '1':
        $mes = 'Enero';
        break;
      case '2':
        $mes = 'Febrero';
        break;
      case '3':
        $mes = 'Marzo';
        break;
      case '4':
        $mes = 'Abril';
        break;
      case '5':
        $mes = 'Mayo';
        break;
      case '6':
        $mes = 'Junio';
        break;
      case '7':
        $mes = 'Julio';
        break;
      case '8':
        $mes = 'Agosto';
        break;
      case '9':
        $mes = 'Septiembre';
        break;
      case '10':
        $mes = 'Octubre';
        break;
      case '11':
        $mes = 'Noviembre';
        break;
      case '12':
        $mes = 'Diciembre';
        break;

    }
    return $mes;
  }
?>