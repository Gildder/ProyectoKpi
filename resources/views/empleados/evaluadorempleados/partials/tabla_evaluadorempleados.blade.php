<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Abreviatura</th>	
			<th>Evaludores</th>	
		</thead>

		<tbody>
		@foreach($evaluadores as $item)
			<tr>
				<td><a href="{{route('empleados.evaluadorempleados.show', $item->id)}}" class="btn btn-warning btn-xs" >{{$item->id}}</a></td>
				<td>{{$item->abreviatura}}</td>
				<td>
					@foreach($item->getEmpleados($item->id) as $empleado)
						{{ $empleado->codigo }}: {{ $empleado->nombres }} {{ $empleado->apellidos }} <br>
					@endforeach
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>