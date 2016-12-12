@extends('layouts.app')

@section('content-header')
	<h1>Empleados</h1>
@endsection

@section('content')
<div class="row" style="border: 1px solid black">
	<div class="col-lg-8 col-lg-offset-2  col-md-10 col-lg-offset-2 col-sm-12 col-xs-12" style="border: 1px solid blue">
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


		<!--tabla de empleados-->
		<div class="row">
			<div class="col-lg-12" style="border:1px solid green">
				<div class="table-response">
					<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Nro</th>
							<th>Nombre</th>	
							<th>Fecha Creacion</th>
							<th>Fecha Actualizacion</th>
							<th>Opciones</th>
						</thead>

						<tbody>
						@foreach($empleados as $empleado)
							<tr>
								<td>{{$empleado->id}}</td>
								<td>{{$empleado->nombre}}</td>
								<td>{{$empleado->created_at}}</td>
								<td>{{$empleado->updated_at}}</td>
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
		<!--Fin tabla de empleados-->

	</div>
</div>


@endsection