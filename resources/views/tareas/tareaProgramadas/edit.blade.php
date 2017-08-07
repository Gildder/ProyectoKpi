@extends('layouts.app')

@section('titulo')
    Tarea Nro. {{$tarea->numero}}
@endsection

@section('content')

<!-- Nuevo -->

<div class="panel panel-default"  id="formEditarTarea">
  <div class="panel-heading">
      <a  href="{{route('tareas.tareaProgramadas.show', $tarea->id)}}" @click="mostrarModalLoading()"
          class="btn btn-primary btn-xs pull-left btn-back" title="Volver">
        <span class="fa fa-reply"></span>
      </a>
    <p class="titulo-panel">Editar - Tarea Nro. {{$tarea->numero}}</p>
  </div>

  <div class="panel-body">

      @include('partials/alert/error')

      <div class="breadcrumb col-sm-12">
          <p class="visible-xs">
              De
              <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaInicio) }}</b>
              hasta
              <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaFin) }}</b>
          </p>
          <p class="hidden-xs">
              Tarea  del
              <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaInicio) }}</b>
              hasta
              <b class="fechaTareas">{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaFin) }}.</b>
              <b > Los campos con (*) son obligatorios </b>
          </p>
      </div>
      
      {!!Form::model($tarea, ['route'=>['tareas.tareaProgramadas.update', $tarea->id], 'method'=>'PUT'])!!}
      {!! Form::hidden('id', $tarea->id) !!}

      {{-- Descripcion --}}
<div class="">
  <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-5
    @if ($errors->has('descripcion'))
          has-error
    @endif">

    <label class="form-group">Descripcion *</label>
    <input  type="text" minlength="5"
            maxlength="60" name="descripcion" placeholder="Descripcion"
            placeholder="Descripcion" class="form-control" value="{{ $tarea->descripcion }}"
            required>
    @if ($errors->has('descripcion'))
      <p class="help-block">{{ $errors->first('descripcion') }}</p>
    @endif
  </div>
</div>

{{-- Fecha de Estimada --}}
        <div class="form-group col-xs-12 row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2
                @if ($errors->has('fechaInicioEstimado'))
                  has-error
                @endif">

                <label>Fecha de Comienzo *: </label>

                <input-date tipo="text" nombre="fechaInicioEstimado"
                          {{--value="{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)}}"--}}
                          valor="{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)}}" placeholder="Comienzo"
                          fechainicio="{{  \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaInicio) }}"
                          fechafin='{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaFin) }}' >
                </input-date>
                @if ($errors->has('fechaInicioEstimado'))
                  <p class="help-block">{{ $errors->first('fechaInicioEstimado') }}</p>
                @endif
            </div>

            <div class=" col-xs-12 col-sm-3 col-md-3 col-lg-2
                @if ($errors->has('fechaFinEstimado'))
                          has-error
                @endif">
                <label >Fecha de Finalizacion *: </label>

                <input-date tipo="text" nombre="fechaFinEstimado"
                          {{--value="{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)}}"--}}
                          valor="{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)}}" placeholder="Comienzo"
                          fechainicio="{{  \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaInicio) }}"
                          fechafin='{{ \Calcana::cambiarFormatoEuropeo(\Cache::get('semanas')->fechaFin) }}' >
                </input-date>
                @if ($errors->has('fechaFinEstimado'))
                  <p class="help-block">{{ $errors->first('fechaFinEstimado') }}</p>
                @endif
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
                <span id="observacion" style="color: green; font-weight: bold;"></span>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="checkbox">
                    <label>
                        <input  type="checkbox" name="todasemana"  id="default-fechaEstimadas">
                        Utilizar fechas de la semana
                    </label>
                </div>
            </div>
      </div>

      {{-- estado --}}
      <div class="row col-sm-12">
          <div class="form-group  col-xs-12 col-sm-3 col-md-3 col-lg-3">
              <label >Estado </label>
{{--              {!! Form::select('estado', [ '1' => 'Programado', '2' => 'En Progreso'], $tarea->estado, ['class' => 'form-control' ]) !!}--}}
              <select class="form-control" name="estado">
                  <option value="" >Seleccionar...</option>
                  @foreach($estados as $estado)
                      @if(($estado->id == $tarea->estadoTarea_id)&& (isset($tarea->estadoTarea_id)))
                          <option value="{{$estado->id}}" selected="selected" >{{$estado->nombre}}</option>
                      @else
                          <option value="{{$estado->id}}" >{{$estado->nombre}}</option>
                      @endif
                  @endforeach
              </select>
          </div>
      </div>
{{-- Tiempo estimado --}}
<div class="row col-sm-12">
  <label class="form-group col-sm-12 col-xs-12">Tiempo Estimado *</label>
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2
        @if ($errors->has('hora'))
              has-error
        @endif">
        <p>Horas:<p>
          <input type="number" name="hora" min="0" max="999"
                 value="{{$tarea->sacarHoras($tarea->tiempoEstimado)}}"
                 placeholder="Horas"
                 class="form-control" value="00"  required >
        @if ($errors->has('hora'))
          <p class="help-block">{{ $errors->first('hora') }}</p>
        @endif
    </div>

    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2
      @if ($errors->has('minuto'))
            has-error
      @endif">
      <p>Minutos:</p>
       <input type="number" name="minuto" min="0"
              value="{{$tarea->sacarMinutos($tarea->tiempoEstimado)}}"
              placeholder="Minutos"
              max="999" class="form-control" value="00"   required>
      @if ($errors->has('minuto'))
        <p class="help-block">{{ $errors->first('minuto') }}</p>
      @endif
    </div>
</div>
    {{-- Fin Body Panel --}}
    </div>

    {{-- Footer de Panel --}}
    <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('tareas.tareaProgramadas.show', $tarea->id)}}" @click="mostrarModalLoading()" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>

        <button type="submit" name="guardar" @click="mostrarModalLoading()" class="btn btn-success"><span class="fa fa-save"></span> Guardar</button>
    </div>
      {!! Form::close()!!}
</div>

<!-- Fin Nuevo -->

<script>
    $('#default-fechaEstimadas').click(function () {
        var fechaInicio = $('input[name=fechaInicioEstimado]');
        var fechaFin = $('input[name=fechaFinEstimado]');
        var mensaje = $('#observacion');


        if(this.checked){
            fechaInicio.attr('disabled', true);
            fechaFin.attr('disabled', true);

            mensaje.html('La tarea esta programada para toda la semana.');
        }else{
            fechaInicio.attr('disabled', false);
            fechaFin.attr('disabled', false);

            mensaje.html('');
        }
    });

</script>

@endsection







