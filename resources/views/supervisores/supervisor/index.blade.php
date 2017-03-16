@extends('layouts.app')

@section('titulo')
	Supervisores
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
      		<p class="titulo-panel" style="display: inline-block;">Supervisores</p>
			<a href="#" title="Informacion" class="btn btn-primary btn-xs pull-right"><span class="fa fa-info"></span></a>
		</div>
		<div class="panel-body">

			<!--panelTab -->
			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#departamentos">Departamentos</a></li>
			  <li><a data-toggle="tab" href="#cargos">Cargos</a></li>
			</ul>
			<br>

			
			<div class="tab-content">
				<div id="departamentos" class="tab-pane fade in active">
					@include('partials/alert/error')
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<p>Puede agregar empleados que supervisen los indicadores por departamentos.</p><br>
					</div>

						<div class="row">
							<div class="col-lg-12">
					        	@include("supervisores/supervisor/partials/tabla_departamentos")
							</div>
						</div>
				</div>

				<div id="cargos" class="tab-pane">
					@include('partials/alert/error')
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<p>Puede agregar empleados que supervisen los indicadores por cargo o puesto.</p><br>
					</div>

					<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
			        	@include("supervisores/supervisor/partials/tabla_cargos")
					</div>
				</div>
				<!-- Fin Panel Tab -->
			</div>
		</div>
		<div class="panel-footer">
		</div>
	</div>

@endsection