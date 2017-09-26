@extends('layouts.app')

@section('titulo')
    Tarea Nro. {{$tarea->numero}}
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default"  id="formEditarTarea">
  <div class="panel-heading">
    <p class="titulo-panel">Editando Tarea <b></b> </p>
  </div>

  <div class="panel-body">

      {!!Form::model($tarea, ['route'=>['tareas.tareaProgramadas.update', $tarea->id], 'method'=>'PUT'])!!}

      @include('partials/alert/error')
{{-- Descripcion --}}
<div class="">
  <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-5
    @if ($errors->has('descripcion'))
          has-error
    @endif">

    <label class="form-group">Descripcion *</label>
    <input  type="text" minlength="5"
            maxlength="120" name="descripcion" placeholder="Descripcion"
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

        <label>Fecha de Inicio *: </label>
        <input-date tipo="text" nombre="fechaInicioEstimado"
                    agendar="{{ $agendar }}"
                    valor="{{  $tarea->fechaInicio}}" placeholder="Fecha Inicio"
                    fechainicio="{{   $semanas->fechaInicio }}"
                    fechafin='{{  $semanas->fechaFin }}' >
        </input-date>

        @if ($errors->has('fechaInicioEstimado'))
          <p class="help-block">{{ $errors->first('fechaInicioEstimado') }}</p>
        @endif
    </div>

    <div class=" col-xs-12 col-sm-3 col-md-3 col-lg-2
        @if ($errors->has('fechaFinEstimado'))
                  has-error
        @endif">
        <label >Fecha Fin *: </label>

        <input-date tipo="text" nombre="fechaFinEstimado"
                    agendar="{{ $agendar }}"
                    valor="{{$tarea->fechaFin }}" placeholder="Fecha Fin"
                    fechainicio="{{   $semanas->fechaInicio }}"
                    fechafin='{{  $semanas->fechaFin }}' >
        </input-date>

        @if ($errors->has('fechaFinEstimado'))
          <p class="help-block">{{ $errors->first('fechaFinEstimado') }}</p>
        @endif
    </div>
    <div v-if="false" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 0;">
        <span id="observacion" style="color: green; font-weight: bold;"></span>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" v-if="false">
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
      <select class="form-control" name="estado">
          <option value="" >Seleccionar...</option>
          @foreach($estados as  $estado)
            @if($estado->id == $tarea->estado_id)
                  <option value="{{ $estado->id }}" selected>{{ $estado->nombre }}</option>
            @endif
                <option value="{{ $estado->id }}" >{{ $estado->nombre }}</option>
          @endforeach
      </select>
  </div>
</div>

{{-- Tiempo estimado --}}
<div class="row col-sm-12">
  <label class="form-group col-sm-12 col-xs-12">Tiempo *</label>
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2
        @if ($errors->has('hora'))
              has-error
        @endif">
        <p>Horas:<p>
          <input type="number" name="hora" min="0" max="999" value="{{ \Calcana::sacarHoras($tarea->tiempo) }}" placeholder="Horas" class="form-control" value="00"  required >
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
              placeholder="Minutos"
              max="999" class="form-control" value="{{ \Calcana::sacarMinutos($tarea->tiempo) }}"   required>
      @if ($errors->has('minuto'))
        <p class="help-block">{{ $errors->first('minuto') }}</p>
      @endif
    </div>
</div>

{{-- Observaciones --}}
<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-5">
      <label>Observaciones</label>
      <textarea type="textArea" name="observaciones"  maxlength="120" placeholder="Observaciones" class="form-control" rows="5" cols="9">{{ $tarea->observaciones }}</textarea>
  </div>
</div>

    {{-- Fin Body Panel --}}
    </div>

    {{-- Footer de Panel --}}
    <div class="panel-footer text-right">
        <a  id="cancelar" href="{{route('tareas.tareaProgramadas.show', $tarea->id)}}"
            class="btn btn-danger"
            type="reset"><span class="fa fa-times">
          </span> Cancelar</a>

        <button  href="#" type="submit"   class="btn btn-success"><span class="fa fa-save"></span> Guardar</button>
    </div>
    {!! Form::hidden('id' ) !!}
</div>

<!-- Fin Nuevo -->

<script>


</script>

@endsection





