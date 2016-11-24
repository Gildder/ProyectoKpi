@extends('layouts.app')

@section('content')
<div class="row" style="border: 1px solid black">
	<div class="col-lg-8 col-lg-offset-2  col-md-10 col-lg-offset-2 col-sm-12 col-xs-12" style="border: 1px solid blue">
		<h3>Cargos</h3>
		<button  id="nuevo"  name="nuevo" onclick="mostrarFormRegistro()" class="btn btn-success">Nuevo</button>

		<div id="formNuevo" class="panel panel-default" style="background: #D9D8DE; padding: 20px; display: none;">
			<form action="{{ route('empleados.cargo.store') }}">
				
	            <div class="form-group">
	            	<label for="nombre">Nombre</label>
	            	<input type="text" name="nombre" class="form-control" placeholder="Nombre">
	            </div>
	            <div class="form-group">
	            	<button class="btn btn-primary" type="submit">Guardar</button>
	            	<button onclick="ocultarFormRegistro()" class="btn btn-danger" type="reset">Cancelar</button>
	            </div>

			</form>
		</div>


		<!--tabla de cargos-->
		<div class="row">
			<div class="col-lg-12" style="border:1px solid green">
				<div class="table-response">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Nro</th>
							<th>Nombre</th>	
							<th>Fecha Creacion</th>
							<th>Fecha Actualizacion</th>
							<th>Opciones</th>
						</thead>

						<tbody>
						@foreach($cargos as $cargo)
							<tr>
								<td>{{$cargo->id}}</td>
								<td>{{$cargo->nombre}}</td>
								<td>{{$cargo->created_at}}</td>
								<td>{{$cargo->updated_at}}</td>
								<td>
									<a href="" class="btn btn-warning">Editar</a>
									<a href="" class="btn btn-danger">Eliminar</a>
								</td>
							</tr>
						@endforeach
						</tbody>
				
					</table>
				</div>
			</div>
		</div>
		<!--Fin tabla de cargos-->

	</div>
</div>

<script  >
	function nuevoGrupo(){
		$("#nuevo").click(function(e){
			document.location.href = "{{ route('empleados.cargo.create') }}";
		});
	}

	function CancelarRegistro(){
		$("#nuevo").click(function(e){
			document.location.href = "{{ route('empleados.cargo.create') }}";
		});
	}

	function mostrarFormRegistro(e){
		$("#formNuevo").slideDown();
		$("#nuevo").css("display", "none");

		e.preventDefault();
	}

	function ocultarFormRegistro(e){
		$("#formNuevo").slideUp();
		$("#nuevo").css("display", "block");
		e.preventDefault();
	}


</script>

@endsection