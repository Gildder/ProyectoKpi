<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre</th>	
			<th>Cargo</th>	
			<th>Departamentos</th>	
		</thead>

		<tbody>
		@foreach($empleadosDisponibles as $item)
			<tr>
				<td><a href="{{route('supervisores.supervisados.show', $item->codigo)}}" onclick="{{Cache::forever('emp_sado', $item->codigo.': '. $item->nombres .' '. $item->apellidos )}}" class="btn btn-warning btn-xs" ><span class=""  title="Ver"></span><span >{{$item->codigo}}</span></a></td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>{{$item->cargo}}</td>
				<td>{{$item->departamento}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>