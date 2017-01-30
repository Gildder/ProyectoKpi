<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Abreviatura</th>	
			<th>Descripcion</th>	
			<th>Cargos Evaluados</th>	
		</thead>

		<tbody>
			@foreach($evaluadores as $item)
				<tr>
					<td><a href="{{route('empleados.evaluadorcargos.show', $item->id)}}" class="btn btn-warning btn-xs" >{{$item->id}}</a></td>
					<td>{{$item->abreviatura}}</td>
					<td>{{$item->descripcion}}</td>
					<td> 
						@foreach($item->getCargos($item->id) as $cargo)
							{{ $cargo->nombre }} <br>
						@endforeach
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>