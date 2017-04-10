<div class="table-response">
	<table  id="myTable2" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Cargos</th>	
			<th>Supervisores</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($cargos as $item)
			<tr>
				<td> {{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td> 
					@foreach($item->getsupervisores($item->id) as $empleado)
						{{ $empleado->codigo }} - {{ $empleado->nombres }} {{ $empleado->apellidos }}  <br>
					@endforeach
				</td>
				<td><a href="{{ route('supervisores.supervisor.show', array($item->id, 0))  }}" class="btn btn-info btn-xs" class="btn btn-primary btn-xs" title="Agregar Supervisor"><span class="fa fa-user-plus"></span></a></td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>