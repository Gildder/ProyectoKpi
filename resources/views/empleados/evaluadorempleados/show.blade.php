@extends('layouts.app')

@section('titulo')
	{{$evaluador->id}} - {{$evaluador->abreviatura}}
@endsection

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel">{{$evaluador->abreviatura}} {{$evaluador->descripcion}}</p>
	</div>

	<div class="panel-body">

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#evaluadores">Evaluadores</a></li>
		</ul>

		<div class="tab-content">
			<div id="evaluadores" class="tab-pane fade in active">
				<div class="col-lg-12 breadcrumb">
					<a href="{{route('empleados.evaluadorempleados.index')}}" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
				</div>

				<div class="content">
					@include('empleados/evaluadorempleados/partials/seleccionar_empleado') 
				</div>
			</div>
		</div>
		<!-- Fin Panel Tab -->

	</div>
	<div class="panel-footer">
	</div>
		
</div>

@endsection


