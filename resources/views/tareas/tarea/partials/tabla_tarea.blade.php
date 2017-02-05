<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Descripcion</th>	
			<th>Fecha Inicio</th>	
			<th>Fecha Fin</th>	
		</thead>

		<tbody>
		@foreach($tareas as $tarea)
			<tr>
				<td><a href="{{route('tareas.tarea.show', $tarea->id )}}" class="btn btn-warning btn-xs" ><span class=""  title="Eliminar"></span><span >{{$tarea->id}}</span></a></td>
				<td>{{$tarea->descripcion}}</td>
				<td>{{$tarea->fechaInicio}}</td>
				<td>{{$tarea->fechaFin}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>