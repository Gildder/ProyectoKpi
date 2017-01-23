<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre Completo</th>	
			<th>Cargo</th>	
			<th>Localizacion</th>	
			<th>Departamentos</th>	
		</thead>

		<tbody>
		@foreach($empleados as $item)
			<tr>
				<td><a href="{{route('supervidores.indicadores.show', $item->codigo )}}" class="btn btn-primary btn-xs" >{{$item->codigo}}</a></td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>{{$item->cargo}}</td>
				<td>{{$item->localizacion}}</td>
				<td>{{$item->departamento}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>