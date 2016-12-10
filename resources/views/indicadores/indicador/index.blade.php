@extends('layouts.app')

@section('content')
	<h1 class="box-title">Lista de Indicadores</h1>
	<hr>
		
	<!--tabla de cargos-->
	<div class="row">
		<div class="col-lg-12">
			<div class="table-response">
				<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Nro</th>
						<th>Nombre</th>	
						<th>Objetivo</th>	
						<th>Condicion</th>	
						<th>Frecuencia</th>	
						<th class="hidden-xs">Fecha Creacion</th>
						<th class="hidden-xs">Fecha Actualizacion</th>
						<th >Opciones</th>
					</thead>

					<tbody>
					@foreach($indicadores as $indicador)
						<tr>
							<td>{{$indicador->id}}</td>
							<td>{{$indicador->nombre}}</td>
							<td>{{$indicador->objetivo}} %</td>
							<td>{{$indicador->condicion}}</td>
							<td>{{ $indicador->frecuencia}}</td>
							<td class="hidden-xs">{{$indicador->created_at}}</td>
							<td class="hidden-xs">{{$indicador->updated_at}}</td>
							<td>
								<a href="{{route('indicadores.indicador.edit', $indicador->id)}}" class="btn btn-primary btn-small" ><span class=""  title="Baja"></span><span >Ver</span></a>
							</td>
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