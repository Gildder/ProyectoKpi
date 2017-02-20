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


			{{-- Opciones de Menu --}}
		    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
		      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		        <a  href="{{route('localizaciones.departamento.create')}}" class="btn btn-primary btn-sm" title="Nuevo"><span class="fa fa-plus">  </span>   <b>Nuevo</b></a>
		        
		      </div>
		      <div class="text-right col-xs-6 col-sm-6 col-md-6 col-lg-6" tabindex="2" >
		        <a  href="{{route('localizaciones.departamento.eliminados')}}" class="btn btn-danger btn-sm"  title="Eliminados"><span class="fa  fa-trash"></span>  <b></b></a>
		      </div>
		    </div>
		    {{-- Fin Opciones Menu --}}

		    
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