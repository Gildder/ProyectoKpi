@extends('layouts.app')

@section('titulo')
	{{$escala->id}} - {{$escala->nombre}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	 <a href="{{route('evaluadores.escala.index')}}" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel">{{$escala->id}} - {{$escala->nombre}}</p>
	</div>

	<div class="panel-body">
		<div id="datos" class="tab-pane fade in active">
			<div class="content col-sm-6">

				@include('partials/alert/error')

				@include('evaluadores/escala/partials/datos_escala')	

				@include("evaluadores/escala/delete")
			</div>
		</div>

	</div>
	<div class="panel-footer text-right">

		<a href="{{route('evaluadores.escala.edit', $escala->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
		<a href="#"  data-toggle="modal" data-target="#modal-delete-{{$escala->id}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>

	</div>
		
</div>

@endsection


