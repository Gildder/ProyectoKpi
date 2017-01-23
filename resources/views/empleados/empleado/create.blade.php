@extends('layouts.app')

@section('titulo')
	Nuevo Empleado
@endsection

@section('content')

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
      <strong>Nuevo Empleado</strong>
  </div>
  <div class="panel-body">

	<div class="col-lg-12 breadcrumb">
		<a  href="{{route('empleados.empleado.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
	</div>
      <p>Todos los campos del formulario son requiridos, por favor llene todos.</p>

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

