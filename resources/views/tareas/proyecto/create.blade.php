@extends('layouts.app')

@section('titulo')
  Nuevo proyecto
@endsection

@section('content')

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">Nuevo proyecto</p>
      
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="{{route('tareas.proyecto.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
  </div>
      <div class="col-sm-12"><p>Los campos con (*) son obligatorios</p><br></div>
      
      {!!Form::open(['route'=>'tareas.proyecto.store', 'method'=>'POST'])!!}

        <div class="form-group @if ($errors->has('nombre')) has-error @endif  col-sm-6">
            <label for="nombre" class="hidden-xs">Nombre *</label>
            <input type="text" minlength="5" maxlength="40" name="nombre" placeholder="Ingresa el Nombre" class="form-control" required>
            @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
        </div>


        {{-- Fecha de Inicio --}}
        <div class="row col-sm-12">
          <div class="form-group @if ($errors->has('fechaInicio')) has-error @endif  col-sm-6">
            <label>Fecha Inicio *</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" id="fechaInicio"  class="form-control datepicker" placeholder="aaaa-mm-dd" name="fechaInicio" required>

              @if ($errors->has('fechaInicio')) <p class="help-block">{{ $errors->first('fechaInicio') }}</p> @endif
            </div>
           </div>

          {{-- Fecha de Fin --}}
           <div class="form-group @if ($errors->has('fechaFin')) has-error @endif  col-sm-6">
            <label>Fecha Inicio *</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" id="fechaFin"  class="form-control datepicker" placeholder="aaaa-mm-dd" name="fechaFin" required>
              @if ($errors->has('fechaFin')) <p class="help-block">{{ $errors->first('fechaFin') }}</p> @endif
            </div>
           </div>
        </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('tareas.proyecto.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>
<!-- Fin Nuevo -->

@endsection