<script>

$(document).ready(function() {
    $('#myTableTareas').DataTable();
 
});

</script>

	<table id="myTableTareas" class="table table-responsive table-striped table-bordered table-condensed table-hover display">
		<thead>
			<th>Nro</th>
			<th>Descripcion</th>	
			<th>Fecha Inicio </th>	
			<th>Fecha Fin  </th>	
			<th>Tiempo Estimado</th>	
			<th>Fecha Inicio Ejecucion </th>	
			<th>Fecha Fin Ejecucion </th>	
			<th>Tiempo Ejecucion</th>	
			<th>Estado</th>	
			<th>Observacion</th>	
			<th>Ubicaciones</th>	
		</thead>
		<tbody>
@foreach($tareas as $tarea)
<tr>
	<td><a href="{{route('tareas.tareaProgramadas.show', $tarea->id )}}" @click="mostrarModalLoading()"  class="btn btn-warning btn-xs" title="Ver"><span >{{$tarea->id}}</span></a></td>
	<td>{{$tarea->descripcion}}</td>
	<td> {{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)}} </td>
	<td>{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)}}</td>
	<td>{{$tarea->tiempoEstimado}}</td>
	<td>{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioSolucion)}}</td>
	<td>{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinSolucion)}}</td>
	<td> {{$tarea->tiempoSolucion}}</td>
	<td> <span class="badge bg-{{ $tarea->getEstadoColor() }}"> {{$tarea->getEstado()}} </span> </td>
	<td>{{$tarea->getObservacion() }}</td>
	<td>
		<ul style="padding: 10px;">
		@foreach($tarea->ubicacionesOcupadas($tarea->id) as $ubicacion)
			<li>{{ $ubicacion->nombre }} </li>
		@endforeach
		</ul>
	</td>
</tr>
@endforeach
		</tbody>

	</table>
