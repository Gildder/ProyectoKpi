<div class="table-response">
	<table  id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Departamentos</th>	
			<th>Supervisores</th>	
		</thead>

		<tbody>
		@foreach($indicadores as $item)
			<tr>
				<td><a href="{{route('supervisores.supervisor.show', $item->id)}}" class="btn btn-warning btn-xs" ><span >{{$item->id}}</span></a></td>
				<td>{{$item->nombre}}</td>
				<td> 
					@foreach($item->getsupervisores($item->id) as $empleado)
						{{ $empleado->codigo }} - {{ $empleado->nombres }} {{ $empleado->apellidos }}  <br>
					@endforeach
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>