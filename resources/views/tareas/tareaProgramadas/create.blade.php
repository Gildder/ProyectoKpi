@extends('layouts.app')

@section('titulo')
  Nueva Tarea
@endsection

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
      <strong>Nueva Tarea</strong>
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
  </div>
  <div class="col-sm-12"><p>Los campos con (*) son obligatorios</p></div>

      {!!Form::open(['route'=>'tareas.tareaProgramadas.store', 'method'=>'POST'])!!}

{{-- Descripcion --}}
<div class="col-sm-12">
  <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-sm-4">
    <label class="form-group">Descripcion *</label>
    <input  type="text" minlength="5" maxlength="60" name="descripcion" placeholder="Descripcion" class="form-control" required>
    @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
  </div>
</div>

{{-- Tiempo estimado --}}
  <div class="col-sm-12">
    <label class="form-group col-sm-12 col-xs-12">Tiempo Estimado *</label>
      <div class="form-group  col-xs-6 col-sm-3 col-md-2 @if ($errors->has('hora')) has-error @endif">
        Horas:<input type="number" name="hora" max="999"  class="form-control" value="00"  required >
        @if ($errors->has('hora')) <p class="help-block">{{ $errors->first('hora') }}</p> @endif

      </div> 
      <div class="col-xs-6 col-sm-4 col-md-2 @if ($errors->has('minuto')) has-error @endif">
        Minutos: <input type="number" name="minuto" max="999" class="form-control" value="00"   required>
        @if ($errors->has('minuto')) <p class="help-block">{{ $errors->first('minuto') }}</p> @endif
      </div>
  </div>

<div class="form-group col-sm-12">
<hr>
  <label class="form-group col-xs-12 col-sm-12">Semana Programada *</label>
  <small class="form-group col-sm-12">Selecciona la semana que deseas programar tu tarea.</small><br><br>
  {{-- Fecha de Inicio --}}
  <div class="form-group col-sm-12">
      Selecciona:
      <select name="selecion_semana" id="selecion_semana">
        @foreach($semanas as $item)
          <option value="{{$item['semana']}}">Semana {{$item['semana']}} del Mes de {{nombreMes($item['mes'])}}</option> 
        @endforeach
      </select>
  </div>
  <div class="row form-group  col-sm-12">
    <div class="col-xs-12 col-sm-4 col-md-2">
      <b>Fecha Inicio: </b>
      <input type="date"  id="fechaInicio" class="form-control" name="fechaInicioEstimado"  readonly="readonly"  >
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2">
      <b>Fecha Fin: </b>
      <input type="date" id="fechaFin" class="form-control" name="fechaFinEstimado" readonly="readonly" >
    </div>
  </div>
</div>
        {{-- Fin body  model --}}
        </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit']) !!}
  </div>
      {!! Form::close()!!}
</div>

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