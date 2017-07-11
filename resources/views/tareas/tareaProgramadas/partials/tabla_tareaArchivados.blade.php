<script>

$(document).ready(function(){
    $(".1").addClass("bg-danger");
    $(".2").addClass("bg-warning");
    $(".3").addClass("bg-success");

});

</script>
<div class="table-response">
	<table id="myTable2" class="table  table-striped table-bordered table-condensed table-hover">
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
			<th>Ubicacion</th>		
		</thead>

		<tbody>
@foreach($tareas as $tarea)
<tr>
	<td><a href="{{route('tareas.tareaProgramadas.show', $tarea->id )}}" class="btn btn-warning btn-xs" title="Ver"><span >{{$tarea->id}}</span></a></td>
	<td>{{$tarea->descripcion}}</td>
	<td> {{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)}} </td>
	<td>{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)}}</td>
	<td>{{$tarea->tiempoEstimado}}</td>
	<td>{{$tarea->cambiarFormatoEuropeo($tarea->fechaInicioSolucion)}}</td>
	<td>{{$tarea->cambiarFormatoEuropeo($tarea->fechaFinSolucion)}}</td>
	<td> {{$tarea->tiempoSolucion}}</td>
	<td> <span class="badge bg-{{ $tarea->estadoTarea_id }}"> {{$tarea->estadoTarea_id }} </span> </td>
	<td>{{$tarea->getObservacion() }}</td>
	<td>
		<ul>
		@foreach($tarea->ubicacionesOcupadas($tarea->id) as $ubicacion)
			o <li>{{ $ubicacion->nombre }} </li>
		@endforeach
		</ul>
	</td>
</tr>
@endforeach
		</tbody>

	</table>
</div>
