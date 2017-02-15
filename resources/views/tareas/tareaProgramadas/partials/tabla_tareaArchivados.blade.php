<div class="table-response">
	<table id="myTable2" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Descripcion</th>	
			<th>Fecha Inicio Ejecucion</th>	
			<th>Fecha Fin Ejecucion </th>	
			<th>Tiempo Ejecucion</th>	
			<th>Estado</th>	
			<th>Ubicacion</th>	
		</thead>

		<tbody>
		@foreach($tareas as $tarea)
			<tr>
				<td><a href="{{route('tareas.tareaProgramadas.show', $tarea->id )}}" class="btn btn-warning btn-xs" ><span class=""  title="Eliminar"></span><span >{{$tarea->id}}</span></a></td>
				<td>{{$tarea->descripcion}}</td>
				<td>@if($tarea->fechaInicioSolucion == '') _/_/_ @else  {{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)}}  @endif</td>
				<td>@if($tarea->fechaFinSolucion == '') _/_/_ @else  {{$tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)}}  @endif</td>
				<td>@if($tarea->tiempoEstimado == '') 00:00 @else  {{$tarea->tiempoEstimado}}  @endif</td>
				<td>{{$tarea->getEstado($tarea->id)}}</td>
				<td>
					@foreach($tarea->ubicacionesOcupadas($tarea->id) as $ubicacion)
						{{ $ubicacion->nombre }}  <br>
					@endforeach
				</td>
			</tr>

			
		@endforeach
		</tbody>

	</table>
</div>