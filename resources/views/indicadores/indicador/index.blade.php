@extends('layouts.app')

@section('content')
	<h1 class="box-title">Indicadores</h1>
	<hr>
		
	<!--tabla de cargos-->
	<div class="row">
		<div class="col-lg-12">
			<div class="table-response">
				<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Nro</th>
						<th>Orden</th>	
						<th>Nombre</th>	
						<th>Tipo</th>	
						<th>Objetivo</th>	
						<th>Condicion</th>	
						<th>Frecuencia</th>	
					</thead>

					<tbody>
					@foreach($indicadores as $indicador)
						<tr>
							<td><a href="{{route('indicadores.indicador.edit', $indicador->id)}}" class="btn btn-primary btn-xs" ><span class=""  title="Baja"></span><span >{{$indicador->id}}</span></a></td>
							<td>{{$indicador->orden}}</td>
							<td>{{$indicador->nombre}}</td>
							<td>{{$indicador->tipo_indicador_id}}</td>
							<td>{{$indicador->descripcion_objetivo}} {{$indicador->objetivo}} %</td>
							<td>{{$indicador->condicion}}</td>
							<td>{{ $indicador->frecuencia}}</td>
						</tr>
					@endforeach
					</tbody>
			
				</table>
			</div>
		</div>
		

	</div>
           



	<!--Fin tabla de cargos-->

   <!-- Alertable -->
  <link rel="stylesheet" href="{{URL::asset('plugins/jquery_alertable/jquery.alertable.css')}}">
  <script src="{{URL::asset('plugins/jquery_alertable/jquery.alertable.js')}}"></script>

<script>


	$(document).ready(function(){
	    $('#myTable').DataTable();
		//$("#formNuevo").css("display", "none");
		//$(".alert").css("display", "none");

	});


</script>


@endsection