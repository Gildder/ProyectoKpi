@extends('layouts.app')

@section('titulo')
	{{$evaluador->id}} - {{$evaluador->abreviatura}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel">{{$evaluador->abreviatura}} - {{$evaluador->descripcion}}</p>
	</div>

	<div class="panel-body">

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#evaluadores">Evaluadores</a></li>
		</ul>

		<div class="tab-content">
			<div id="evaluadores" class="tab-pane fade in active">
				<div class="col-lg-12 breadcrumb">
					<a href="{{route('empleados.evaluadorempleados.index')}}" class="btn btn-primary btn-xs" title="Volver"><span class="fa fa-reply"></span></a>
				</div>
				

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<p>Elige a los empleados que seran evaluadores de Gerencia.</p><hr>
					</div>

					{{-- Capa de Seleccion Empleado --}}
					<div class="col-sm-7">
						<div class="panel panel-default">
							<div class="panel-heading">
							  <p class="titulo-panel">Selecciona Empleado</p>
							</div>
							<div class="panel-body">
								@include('empleados/evaluadorempleados/partials/tabla_empleados')
							</div>
						</div>
					</div>

					{{-- Capa de empleados Agregados --}}
					<div class="col-sm-5">
							<p class="titulo-panel">Evaluadores </p><br>
						@include('empleados/evaluadorempleados/partials/tabla_agregados')
					</div>
				</div>
			</div>
		</div>
		<!-- Fin Panel Tab -->

	</div>
	<div class="panel-footer">
	</div>
		
</div>

@endsection


