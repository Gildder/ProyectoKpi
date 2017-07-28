<script>

$(document).ready(function() {
    $('#myTableTareas').DataTable();
 
});

</script>

	<table id="myTableTareas" class="table table-responsive table-striped table-bordered table-condensed table-hover display" cellspacing="0" width="100%">
		<thead>
        <tr>
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
        </tr>
		</thead>
		<tbody>
@foreach($tareas as $tarea)
<tr>
	<td><a href="{{route('tareas.tareaProgramadas.show', $tarea->id )}}" @click="mostrarModalLoading()"  class="btn btn-warning btn-xs" title="Ver"><span >{{$tarea->numero}}</span></a></td>
	<td>{{$tarea->descripcion}}</td>
	<td> {{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)}} </td>
	<td>{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)}}</td>
	<td>{{$tarea->tiempoEstimado}}</td>
	<td>{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioSolucion)}}</td>
	<td>{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinSolucion)}}</td>
	<td> {{$tarea->tiempoSolucion}}</td>
	<td> <label class="label label-{{ $tarea->getEstadoColor() }}"> {{$tarea->getEstado()}} </label> </td>
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
