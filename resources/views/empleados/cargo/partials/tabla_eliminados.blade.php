<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($cargos as $cargo)
			<tr>
				<td>{{$cargo->id}}</td>
				<td>{{$cargo->nombre}}</td>
				<td><a  href="#"  data-toggle="modal" data-target="#modal-restaurar-{{$cargo->id}}"  class="btn btn-success btn-xs" ><span class="fa fa-check"  title="Restaurar"></span><span >  Restaurar</span></a></td>
			</tr>
			@include("empleados/cargo/restaurar")

		@endforeach
		</tbody>

	</table>
</div>