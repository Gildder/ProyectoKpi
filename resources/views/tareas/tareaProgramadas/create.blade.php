@extends('layouts.app')

@section('titulo')
  Nueva Tarea
@endsection

@section('content')

<div class="panel panel-default" id="formNuevaTarea">

  <div class="panel-heading">
    <a  href="{{route('tareas.tareaProgramadas.index')}}" class="btn btn-primary btn-xs pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">Nueva Tarea</p>
  </div>

  <div class="panel-body">
        <div class="breadcrumb col-sm-12">
            <p class="visible-xs">
                De
                <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo($semanas->fechaInicio) }}</b>
                hasta
                <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo($semanas->fechaFin) }}</b>
            </p>
            <p class="hidden-xs">
                Tarea programadas del
                <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo($semanas->fechaInicio) }}</b>
                hasta
                <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo($semanas->fechaFin) }}.</b>
                <b > Los campos con (*) son obligatorios </b>
            </p>
        </div>

      @include('partials/alert/error')


      {!!Form::open(['route'=>'tareas.tareaProgramadas.store', 'method'=>'POST'])!!}

    {{-- Descripcion --}}
      <div class="form-group">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4
            @if ($errors->has('descripcion')) has-error @endif">
            <label>Descripcion *</label>
            <input type="text" minlength="5" value="{{ old('descripcion') }}" style="margin-bottom: 15px;"
                   maxlength="50" name="descripcion" placeholder="Descripcion"
                   class="form-control" required>
            @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
          </div>
      </div>

{{-- Fechas de Inicio y Fin --}}
<div class="form-group col-xs-12 row">
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2
        @if ($errors->has('fechaInicioEstimado'))
            has-error
        @endif">

        <label>Fecha de Comienzo *: </label>

        <input-date tipo="text" nombre="fechaInicioEstimado"
                    valor="{{ old('fechaInicioEstimado') }}" placeholder="Comienzo"
                    fechainicio="{{  \Calcana::cambiarFormatoEuropeo($semanas->fechaInicio) }}"
                    fechafin='{{ \Calcana::cambiarFormatoEuropeo($semanas->fechaFin) }}' >
        </input-date>
        @if ($errors->has('fechaInicioEstimado'))
            <p class="help-block">{{ $errors->first('fechaInicioEstimado') }}</p>
        @endif
    </div>

    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2
        @if ($errors->has('fechaFinEstimado'))
            has-error
        @endif">

        <label>Fecha Finalizacion *: </label>

        <input-date tipo="text" nombre="fechaFinEstimado"
                    valor="{{ old('fechaFinEstimado') }}" placeholder="Finalizacion"
                    fechainicio="{{  \Calcana::cambiarFormatoEuropeo($semanas->fechaInicio) }}"
                    fechafin='{{ \Calcana::cambiarFormatoEuropeo($semanas->fechaFin) }}' >

        </input-date>
        @if ($errors->has('fechaFinEstimado'))
            <p class="help-block">{{ $errors->first('fechaFinEstimado') }}</p>
        @endif
    </div>
</div>

  {{-- Tiempo estimado --}}
  <div class="col-sm-12 row">
      <label class="form-group col-sm-12 col-xs-12">Tiempo Estimado *</label>
      <div class="form-group  col-xs-12 col-sm-3 col-md-3 col-lg-2 @if ($errors->has('hora')) has-error @endif">
          Horas:
          <input type="number" min="0"  name="hora" max="999" placeholder="Horas"
                 value="{{ old('hora') }}" class="form-control"
                 required >
          @if ($errors->has('hora'))
              <p class="help-block">{{ $errors->first('hora') }}</p>
          @endif
      </div>

      <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 @if ($errors->has('minuto')) has-error @endif">
          Minutos:
          <input type="number" min="0" name="minuto" max="999"
                 class="form-control" value="{{ old('minuto') }}"  placeholder="Minutos"
                 required>

          @if ($errors->has('minuto'))
              <p class="help-block">{{ $errors->first('minuto') }}</p>
          @endif
      </div>
  </div>

{{-- Fin body  model --}}
</div>
  <div class="panel-footer text-right">
      <a  id="cancelar"
          href="{{route('tareas.tareaProgramadas.index')}}"
          class="btn btn-danger"
          type="reset"><span class="fa fa-times">
          </span> Cancelar</a>

      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit']) !!}
  </div>
{!! Form::close()!!}
</div>

@endsection

