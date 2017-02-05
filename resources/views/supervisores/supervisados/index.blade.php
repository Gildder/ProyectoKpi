@extends('layouts.app')

@section('titulo')
	Supervisiones
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
      		<p class="titulo-panel">Supervisiones</p>

		</div>
		<div class="panel-body">

			<!--panelTab -->
			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#datos">Empleados</a></li>
			</ul>
			
			<br>
			<div class="tab-content">
				<div id="datos" class="tab-pane fade in active">
					@include('partials/alert/error')
					
					<p>Lista de empleados asignados para supervision</p><br>
					<div class="row">
						<div class="col-lg-12">
				        	@include("supervisores/supervisados/partials/tabla_empleados")
						</div>
					</div>
				</div>
				<!-- Fin Panel Tab -->
			</div>
		</div>
		<div class="panel-footer">
		</div>
	</div>

@endsection