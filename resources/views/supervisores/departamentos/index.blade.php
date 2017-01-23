@extends('layouts.app')

@section('titulo')
	Departamentos
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
      		<p class="titulo-panel">Supervisión - Departamentos</p>

		</div>
		<div class="panel-body">
			
			@include('partials/alert/error')

			<div class="row">
				<div class="col-lg-12">
		        	@include("supervisores/departamentos/partials/tabla_departamentos")
				</div>
			</div>

		</div>
		<div class="panel-footer">
		</div>
	</div>

@endsection