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
				<th>Ubicaciones</th>
				<th>Observacion</th>
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
	<td> <label  style="background: {{$tarea->estados->color}}; color:{{$tarea->estados->texto}}; font-size: 10px; padding: 1.5px 5px; border-radius: 15px; box-shadow: 1px 1px gray "> {{$tarea->estados->nombre}} </label> </td>
	<td>
		<ul style="padding: 1px;">
		@foreach($tarea->ubicacionesOcupadas($tarea->id) as $ubicacion)
			<li style="padding: 0;">{{ $ubicacion->nombre }} </li>
		@endforeach
		</ul>
	</td>
	<td>{{$tarea->getObservacion() }}</td>
</tr>
@endforeach
		</tbody>

	</table>
