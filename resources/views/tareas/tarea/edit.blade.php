@extends('layouts.app')

@section('titulo')
  Editar Proyecto
@endsection

@section('content')

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
      <strong>{{ $proyecto->id}} - {{ $proyecto->nombre}}</strong>
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="{{route('tareas.proyecto.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
  </div>

      {!!Form::model($proyecto, ['route'=>['tareas.proyecto.update', $proyecto->id], 'method'=>'PUT'])!!}
        {!! Form::hidden('id', $proyecto->id) !!}
        <div class="form-group @if ($errors->has('nombre')) has-error @endif col-sm-3">
            <label for="nombre" class="hidden-xs">Nombre</label>
            {!! form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingresa el Nombre']) !!}
            @if ($errors->has('nombre')) <p class="help-block">{{ $errors->first('nombre') }}</p> @endif
        </div>


         <div class="row col-sm-12">
          <div class="form-group @if ($errors->has('fechaInicio')) has-error @endif  col-sm-6">
            <label>Fecha Inicio</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::date('fechaInicio', \Carbon\Carbon::now() , ['id'=>'datepicker', 'class'=>'form-control datepicker', 'placeholder'=>'Selecciona fecha']) !!}
              @if ($errors->has('fechaInicio')) <p class="help-block">{{ $errors->first('fechaInicio') }}</p> @endif
            </div>
           </div>

           <div class="form-group @if ($errors->has('fechaFin')) has-error @endif  col-sm-6">
            <label>Fecha Inicio</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::date('fechaFin', \Carbon\Carbon::now() , ['id'=>'datepicker', 'class'=>'form-control datepicker', 'placeholder'=>'Selecciona fecha']) !!}
              @if ($errors->has('fechaFin')) <p class="help-block">{{ $errors->first('fechaFin') }}</p> @endif
            </div>
           </div>
        </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('tareas.proyecto.show', $proyecto->id)}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>

<!-- Fin Nuevo -->


@endsection