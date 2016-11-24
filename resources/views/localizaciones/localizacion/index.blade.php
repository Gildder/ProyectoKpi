@extends('layouts.app')

@section('content')
	<button  id="nuevo"  class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"> Nuevo</span></button>
	<h3>Localizacion</h3>
	<hr>

	<div id="formNuevo" class="panel panel-default row" >
		<form>
			
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" class="form-control" placeholder="Nombre">
            </div>
            <div class="form-group">
            	<button  id="guardar" class="btn btn-success col-xs-12 col-sm-2" type="submit"><span class="glyphicon glyphicon-ok"> Guardar</span></button>
            	<button  id="cancelar" class="btn btn-danger col-xs-12 col-sm-2 " type="reset"><span class="glyphicon glyphicon-remove"> Cancelar</span></button>
            </div>

		</form>
	</div>


		<!--tabla de cargos-->
		<div class="row">
			<div class="col-lg-12" >
				<div class="table-response">
					<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Nro</th>
							<th>Localizacion</th>	
							<th>Grupo</th>	
							<th>Fecha Creacion</th>
							<th>Fecha Actualizacion</th>
							<th>Opciones</th>
						</thead>

						<tbody>
						@foreach($localizaciones as $grupo)
							<tr>
								<td>{{$grupo->id}}</td>
								<td>{{$grupo->localizacion}}</td>
								<td>{{$grupo->grupo}}</td>
								<td>{{$grupo->created_at}}</td>
								<td>{{$grupo->updated_at}}</td>
								<td>
									<a href="" class="btn btn-warning btn-small"><span class="glyphicon glyphicon-pencil"   title="Editar"></span><span > Editar</span></a>
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
	$('#nuevo').click(function(){
		$("#formNuevo").slideDown();
		$("#nuevo").css("display", "none");
		e.preventDefault();

	});

	$('#cancelar').click(function(){
		$("#formNuevo").slideUp();
		$("#nuevo").css("display", "block");
		e.preventDefault();

	});


$(document).ready(function(){
    $('#myTable').DataTable();
});

</script>

@endsection