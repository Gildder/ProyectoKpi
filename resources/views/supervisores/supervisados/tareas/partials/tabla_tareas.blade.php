<div class="table-responsive">
	<table class="table table-striped table-bordered table-condensed table-hover myDataTables">
		<thead>
            <tr>
                <th>Nro</th>
                <th>Nombre Completo</th>
                <th>Tareas</th>
                <th>Fechas Inicio Estimadas</th>
                <th>Fechas Fin Estimadas</th>
                <th>Tiempo estimados</th>
                <th>Fechas Inicio Ejecucion</th>
                <th>Fechas Fin Ejecucion</th>
                <th>Tiempo Ejecucion</th>
                <th>Estado</th>
                <th>Observaciones</th>
                <th>Ubicaciones</th>
            </tr>
		</thead>

		<tbody>
			@foreach($tareas as $item)
			<tr>
				<td>{{ $item->user_id }}</td>
				<td>{{ $item->nombres }} {{ $item->apellidos }}</td>
				<td>{{ $item->descripcion }}</td>
				<td>{{ $item->fechaInicioEstimado }}</td>
				<td>{{ $item->fechaFinEstimado }}</td>
				<td>{{ $item->tiempoEstimado }}</td>
				<td>{{ $item->fechaInicioEjecucion }}</td>
				<td>{{ $item->fechaFinEjecucion }}</td>
				<td>{{ $item->tiempoSolucion }}</td>
				<td> <span class="badge bg-{{ $item->getEstadoColor() }}"> {{$item->getEstado()}} </span> </td>
				<td>{{$item->getObservacion() }}</td>
				<td>
					<ul style="padding: 10px;">
						@foreach($item->ubicacionesOcupadas($item->id) as $ubicacion)
							<li>{{ $ubicacion->nombre }} </li>
						@endforeach
					</ul>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>



