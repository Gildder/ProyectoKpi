@extends('layouts.app')

@section('content')
	<button  id="nuevo"  class="btn btn-primary pull-right" ><span class="glyphicon glyphicon-plus"> Nuevo</span></button>
	<h3 class="box-title">Cargos</h3>
	<hr>
		
	@include('partials/alert/error')
	

	<!--tabla de cargos-->
	<div class="row">
		<div class="col-lg-12">
			<div class="table-response">
				<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Nro</th>
						<th>Nombre</th>	
						<th class="hidden-xs">Fecha Creacion</th>
						<th class="hidden-xs">Fecha Actualizacion</th>
						<th >Opciones</th>
					</thead>

					<tbody>
					@foreach($cargos as $cargo)
						<tr>
							<td>{{$cargo->id}}</td>
							<td>{{$cargo->nombre}}</td>
							<td class="hidden-xs">{{$cargo->created_at}}</td>
							<td class="hidden-xs">{{$cargo->updated_at}}</td>
							<td>
								<a href="{{route('empleados.cargo.edit', $cargo->id)}}" class="btn btn-warning btn-small"><span class="glyphicon glyphicon-pencil"   title="Editar"></span><span > Editar</span></a>
								<a  onclick="Mostrar({{$cargo->id}})" class="btn btn-danger btn-small" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove-sign"  title="Baja"></span><span > Baja</span></a>
							</td>
						</tr>
					@endforeach
					</tbody>
			
				</table>
			</div>
		</div>
        @include("empleados/cargo/delete")
		

	</div>
           



	<!--Fin tabla de cargos-->

   <!-- Alertable -->
  <link rel="stylesheet" href="{{URL::asset('plugins/jquery_alertable/jquery.alertable.css')}}">
  <script src="{{URL::asset('plugins/jquery_alertable/jquery.alertable.js')}}"></script>

<script>
	$('#nuevo').click(function(e){
		document.location.href = "{{route('empleados.cargo.create')}}";

	});

	$(document).ready(function(){
	    $('#myTable').DataTable();
		//$("#formNuevo").css("display", "none");
		//$(".alert").css("display", "none");

	});

	function Mostrar(id)
	{
		/*
		if(confirm('¿Estas seguro que desea Eliminar '+id+' - ' +nombre+ '?'))
		{
			var route = "{{url('empleados/cargo/destroy')}}/"+ id;
			alert(route);
			document.location.href = route;
		}
		*/

		var route = "{{url('empleados.cargo.show')}}/"+id;
		
		$.get(route, function(data){
			alert(data);
			$('#nombregrupo').val(data.nombre);
		});
		
	}


</script>


@endsection