@extends('layouts.app')

@section('content')
	<button  id="nuevo"  class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"> Nuevo</span></button>
	<h3>Departamentos</h3>
	<hr>
	@include('partials/alert/error')
		<!--tabla de cargos-->
		<div class="row">
			<div class="col-lg-12" >
				<div class="table-response">
					<table  id="myTable" class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Nro</th>
							<th>Departamento</th>	
							<th>Grupo</th>	
							<th class="hidden-xs">Fecha Creacion</th>
							<th class="hidden-xs">Fecha Actualizacion</th>
							<th>Opciones</th>
						</thead>

						<tbody>
						@foreach($departamentos as $grupo)
							<tr>
								<td>{{$grupo->id}}</td>
								<td>{{$grupo->departamento}}</td>
								<td>{{$grupo->grupo}}</td>
								<td class="hidden-xs">{{$grupo->created_at}}</td>
								<td class="hidden-xs">{{$grupo->updated_at}}</td>
								<td>
									<a href="{{route('localizaciones.departamento.edit', $grupo->id)}}" class="btn btn-warning btn-small"><span class="glyphicon glyphicon-pencil"   title="Editar"></span><span > Editar</span></a>
								<a href="" class="btn btn-danger btn-small" ><span class="glyphicon glyphicon-remove-sign"  title="Baja"></span><span > Baja</span></a>
								</td>
							</tr>
						@endforeach
						</tbody>
				
					</table>
				</div>
			</div>
		</div>
		<!--Fin tabla de cargos-->


<script  >
	$('#nuevo').click(function(e){
		document.location.href = "{{route('localizaciones.departamento.create')}}";

	});


	$(document).ready(function(){
	    $('#myTable').DataTable();
	});

</script>

@endsection