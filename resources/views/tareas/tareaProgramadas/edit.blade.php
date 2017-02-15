@extends('layouts.app')

@section('titulo')
  {{$tarea->id}} - {{$tarea->descripcion}}
@endsection

@section('content')

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
      <strong>{{$tarea->id}} - {{$tarea->descripcion}}</strong>
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="{{route('tareas.tareaProgramadas.show', $tarea->id)}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
  </div>


      <div class="col-sm-12"><p>Los campos con (*) son obligatorios</p><br></div>
      
      {!!Form::model($tarea, ['route'=>['tareas.tareaProgramadas.update', $tarea->id], 'method'=>'PUT'])!!}
        {!! Form::hidden('id', $tarea->id) !!}




{{-- Descripcion --}}
<div class="col-sm-12">
  <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-sm-4">
    <label class="form-group">Descripcion *</label>
    <input  type="text" minlength="5" maxlength="60" name="descripcion" placeholder="Descripcion" class="form-control" value="{{ $tarea->descripcion }}" required>
    @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
  </div>
</div>

{{-- Tiempo estimado --}}
  <div class="col-sm-12">
    <label class="form-group col-sm-12 col-xs-12">Tiempo Estimado *</label>
      <div class="form-group  col-xs-6 col-sm-3 col-md-2 @if ($errors->has('hora')) has-error @endif">
        <p>Horas:<p><input type="number" name="hora" max="999"  value="{{$tarea->sacarHoras($tarea->tiempoEstimado)}}"  class="form-control" value="00"  required >
        @if ($errors->has('hora')) <p class="help-block">{{ $errors->first('hora') }}</p> @endif

      </div> 
      <div class="col-xs-6 col-sm-4 col-md-2 @if ($errors->has('minuto')) has-error @endif">
        <p>Minutos:</p>
         <input type="number" name="minuto" value="{{$tarea->sacarMinutos($tarea->tiempoEstimado)}}"  max="999" class="form-control" value="00"   required>
        @if ($errors->has('minuto')) <p class="help-block">{{ $errors->first('minuto') }}</p> @endif
      </div>
  </div>

<div class="form-group col-sm-12">
<hr>
  <label class="form-group col-xs-12 col-sm-12">Fechas Programada *</label>

  {{-- Fecha de Estimada --}}
<div class="form-group col-sm-12">
  <div class="row form-group  col-sm-12">
    <div class="row col-xs-12 col-sm-4 col-md-2 @if ($errors->has('fechaInicioEstimado')) has-error @endif">
      <p >De *: </p>
      <input type="text"  id="fechaInicio" value="{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)}}" class="form-control fechaInicio" name="fechaInicioEstimado" required>
        @if ($errors->has('fechaInicioEstimado')) <p class="help-block">{{ $errors->first('fechaInicioEstimado') }}</p> @endif
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2  @if ($errors->has('fechaFinEstimado')) has-error @endif">
      <p >Hasta *: </p>
      <input type="text" id="fechaFin" value="{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)}}" class="form-control fechaFin" name="fechaFinEstimado" required>
        @if ($errors->has('fechaFinEstimado')) <p class="help-block">{{ $errors->first('fechaFinEstimado') }}</p> @endif
    </div>
  </div>
</div>

      
  </div>
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('tareas.tareaProgramadas.show', $tarea->id)}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>

<!-- Fin Nuevo -->

<script>
  $(document).ready(function(){
      cargarFechas();

      $('#selecion_semana').change(function() {
          cargarFechas();
      });

      function cargarFechas()
      {
        var result = $('#selecion_semana option:selected').attr('value');
          @foreach ($semanas as $item) 
            if({{$item['semana']}} == result)
            {
              $('#fechaInicio').val('{{$item['fechaInicio']}}');
              $('#fechaFin').val('{{$item['fechaFin']}}');
            }
          @endforeach
      }
  });
</script>


@endsection







<?php
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