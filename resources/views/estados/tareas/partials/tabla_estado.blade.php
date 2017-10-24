<div class="table-responsive">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
		</thead>

		<tbody>
		@foreach($cargos as $cargo)
			<tr>
				<td><a href="{{route('empleados.cargo.show', $cargo->id )}}" class="btn btn-warning btn-xs" ><span class=""  title="Eliminar"></span><span >{{$cargo->id}}</span></a></td>
				<td>{{$cargo->nombre}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>
