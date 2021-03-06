@extends('layouts.app')

@section('titulo')
	Nuevo Empleado
@endsection

@section('content')

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="{{route('empleados.empleado.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">Nuevo Empleado</p>
  </div>
  <div class="panel-body">

      <p>Todos los campos con (*) son requiridos</p>

      {!!Form::open(['route'=>'empleados.empleado.store', 'method'=>'POST'])!!}

      @include('empleados/empleado/partials/crear_atributos')
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="{{route('empleados.empleado.index')}}" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
    {!! form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
  </div>
      {!! Form::close()!!}
</div>

<!-- Fin Nuevo -->

@endsection

