@extends('layouts.app')

@section('titulo')
	Lista de Indicadores
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel">{{$empleado->codigo}} - {{$empleado->nombres}} {{$empleado->apellidos}}</p>
	</div>

	<div class="panel-body">

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#datos">Indicadores</a></li>
		</ul>

		<div class="tab-content">
			<div id="datos" class="tab-pane fade in active">
				<div class="col-lg-12 breadcrumb">
					<a href="{{route('empleados.cargo.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
				</div>
				<div class="">
					<div class="content col-sm-6">

						Lista de indicadores
					</div>
					<div class="col-sm-12 panel-footer text-right">
					</div>
				</div>
			</div>
		<!-- Fin Panel Tab -->

	</div>

	</div>
	
		
</div>

@endsection


