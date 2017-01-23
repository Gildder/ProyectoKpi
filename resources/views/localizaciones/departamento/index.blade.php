@extends('layouts.app')

@section('titulo')
	Departamentos
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
      		<p class="titulo-panel">Departamentos</p>

		</div>
		<div class="panel-body">
			
			@include('partials/alert/error')

			<div class="text-left col-lg-12 breadcrumb">
				<a  href="{{route('localizaciones.departamento.create')}}" class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span><b>   Nuevo</b> </a>
			</div>
			<div class="row">
				<div class="col-lg-12">
		        	@include("localizaciones/departamento/partials/tabla_departamento")
				</div>
			</div>

		</div>
		<div class="panel-footer">
		</div>
	</div>

@endsection