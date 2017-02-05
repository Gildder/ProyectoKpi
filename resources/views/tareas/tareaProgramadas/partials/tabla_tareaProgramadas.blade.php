<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Descripcion</th>	
			<th>Fecha Inicio Estimado</th>	
			<th>Fecha Fin Estimado </th>	
			<th>Tiempo Estimado</th>	
			<th>Estado</th>	
		</thead>

		<tbody>
		@foreach($tareas as $tarea)
			<tr>
				<td><a href="{{route('tareas.tareaProgramadas.show', $tarea->id )}}" class="btn btn-warning btn-xs" ><span class=""  title="Eliminar"></span><span >{{$tarea->id}}</span></a></td>
				<td>{{$tarea->descripcion}}</td>
				<td>{{$tarea->fechaInicioEstimado}}</td>
				<td>{{$tarea->fechaFinEstimado}}</td>
				<td>{{$tarea->tiempoEstimado}}</td>
				<td>{{$tarea->fechaInicioSolucion}}</td>
				<td>{{$tarea->fechaFinSolucion}}</td>
				<td>{{$tarea->tiempoSolucion}}</td>
				<td>{{$tarea->estado}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>