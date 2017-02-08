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
        <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-sm-5">
            <label for="descripcion">Descripcion *</label>
            <input type="text" minlength="5" maxlength="60" name="descripcion"  placeholder="Descripcion" class="form-control" value="{{ $tarea->descripcion }}" required>
            @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
        </div>

        <div class="row col-sm-12">
          <div class="col-sm-12"> <label>Fechas Estimadas *</label></div>

          {{-- Fecha de Inicio --}}
          <div class="form-group @if ($errors->has('fechaInicioEstimado')) has-error @endif  col-sm-3">
            De *: 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="date" id="fechaInicioEstimado"  class="form-control fechaInicio"  placeholder="dd/mm/aaaa" name="fechaInicioEstimado" value="{{ $tarea->fechaInicioEstimado }}" required>

            </div>
              @if ($errors->has('fechaInicioEstimado')) <p class="help-block">{{ $errors->first('fechaInicioEstimado') }}</p> @endif
           </div>
            
          {{-- Fecha Fin --}}
           <div class="form-group @if ($errors->has('fechaFinEstimado')) has-error @endif  col-sm-3">
            Hasta *:
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" id="fechaFinEstimado" value="{{ $tarea->fechaFinEstimado }}"  class="form-control fechaFin" name="fechaFinEstimado" placeholder="dd/mm/aaaa" required>

            </div>
              @if ($errors->has('fechaFinEstimado')) <p class="help-block">{{ $errors->first('fechaFinEstimado') }}</p> @endif
           </div>
      

          {{-- Dias Trabajados --}}
           {{--   <div class="form-group @if ($errors->has('tiempoEstimado')) has-error @endif  col-sm-5">
                <label>Dias trabajados </label><br>
                    El total de días trabajados es: <label for="diasTrabajado">100</label>
              @if ($errors->has('tiempoEstimado')) <p class="help-block">{{ $errors->first('tiempoEstimado') }}</p> @endif
            </div>
           --}}
          </div>

        {{-- Tiempo estimado --}}
        <div class="row col-sm-12">
           <div class="form-group @if ($errors->has('tiempoEstimado')) has-error @endif  col-sm-3">
              <label>Tiempo Estimado *</label>
              <div class="input-group">
                  <input type="time" name="tiempoEstimado" value="{{ $tarea->tiempoEstimado }}" class="form-control"  placeholder="Hora:Minutos" required>
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
              </div>
            @if ($errors->has('tiempoEstimado')) <p class="help-block">{{ $errors->first('tiempoEstimado') }}</p> @endif
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


@endsection