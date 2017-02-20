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
        Horas:<input type="number" min="0"  name="hora" max="999"  class="form-control" value="00"  required >

      </div> 
        @if ($errors->has('hora')) <p class="help-block">{{ $errors->first('hora') }}</p> @endif
      <div class="col-xs-6 col-sm-4 col-md-2 @if ($errors->has('minuto')) has-error @endif">
        Minutos: <input type="number" min="0" name="minuto" max="999" class="form-control" value="00"   required>
      </div>
        @if ($errors->has('minuto')) <p class="help-block">{{ $errors->first('minuto') }}</p> @endif
  </div>

<div class="form-group col-sm-12">
  <div class="row form-group  col-sm-12">
    <div class="col-xs-12 col-sm-4 col-md-2 @if ($errors->has('fechaInicioEstimado')) has-error @endif">
      <b>Fecha Inicio *: </b>
      <input type="text"  id="fechaInicio" class="form-control fechaInicio" name="fechaInicioEstimado" required>
        @if ($errors->has('fechaInicioEstimado')) <p class="help-block">{{ $errors->first('fechaInicioEstimado') }}</p> @endif
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2  @if ($errors->has('fechaFinEstimado')) has-error @endif">
      <b>Fecha Fin *: </b>
      <input type="text" id="fechaFin" class="form-control fechaFin" name="fechaFinEstimado" required>
        @if ($errors->has('fechaFinEstimado')) <p class="help-block">{{ $errors->first('fechaFinEstimado') }}</p> @endif
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

@endsection
