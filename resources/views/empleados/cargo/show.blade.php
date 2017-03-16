@extends('layouts.app')

@section('titulo')
	{{$cargo->id}} - {{$cargo->nombre}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	 <a href="{{route('empleados.cargo.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel">{{$cargo->id}} - {{$cargo->nombre}}</p>
	</div>

	<div class="panel-body">
		<div id="datos" class="tab-pane fade in active">
			<div class="content col-sm-6">

					@include('partials/alert/error')

				@include('empleados/cargo/partials/datos_cargo')	

				@include("empleados/cargo/delete")
			</div>
		</div>

	</div>
	<div class="col-sm-12 panel-footer text-right">

		<a href="{{route('empleados.cargo.edit', $cargo->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
		<a href="#"  data-toggle="modal" data-target="#modal-delete-{{$cargo->id}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>

	</div>
		
</div>

@endsection


