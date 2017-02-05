<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Fecha Inicio</th>	
			<th>Fecha Fin</th>	
		</thead>

		<tbody>
		@foreach($proyectos as $proyecto)
			<tr>
				<td><a href="{{route('tareas.proyecto.show', $proyecto->id )}}" class="btn btn-warning btn-xs" ><span class=""  title="Eliminar"></span><span >{{$proyecto->id}}</span></a></td>
				<td>{{$proyecto->nombre}}</td>
				<td>{{$proyecto->fechaInicio}}</td>
				<td>{{$proyecto->fechaFin}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>