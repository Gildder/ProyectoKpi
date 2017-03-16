<div class="table-response">
	<table  id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Departamentos</th>	
			<th>Supervisores</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($departamentos as $item)
			<tr>
				<td><a href="#" class="btn btn-warning btn-xs" class="btn btn-primary btn-xs" title="Ver"><span >{{$item->id}}</span></a></td>
				<td>{{$item->nombre}}</td>
				<td> 
					@foreach($item->getsupervisores($item->id) as $empleado)
						{{ $empleado->codigo }} - {{ $empleado->nombres }} {{ $empleado->apellidos }}  <br>
					@endforeach
				</td>
				<td><a href="{{route('supervisores.supervisor.show', array($item->id, 1)) }}" class="btn btn-info btn-xs" class="btn btn-primary btn-xs" title="Agregar Supervisor"><span class="fa fa-user-plus"></span></a></td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>