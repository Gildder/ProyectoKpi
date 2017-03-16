@extends('layouts.app')

@section('titulo')
  Tareas Archivadas
@endsection

@section('content')
	
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-xs pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">Tareas Archivadas</p>
  </div>

  <div class="panel-body">


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <small>Todas las tareas anteriores a la semana {{$semanas[0]['semana']}} del mes de {{nombreMes($semanas[0]['mes'])}}, del <b>{{cambiarFormatoEuropeo($semanas[0]['fechaInicio'])}}</b> al <b>{{cambiarFormatoEuropeo($semanas[0]['fechaFin'])}}</b></small>
    </div><br><hr>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      @include('tareas/tareaProgramadas/partials/tabla_tareaArchivados')
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

