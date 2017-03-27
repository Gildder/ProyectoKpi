<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Tipo</th>	
			<th>Objetivo</th>	
			<th>Cagos Asignados</th>	
		</thead>

		<tbody>
			@foreach($indicadores as $item)
				<tr>
					<td><a href="{{route('indicadores.indicadorcargos.show', $item->id)}}" class="btn btn-warning btn-xs" >{{$item->id}}</a></td>
					<td>{{$item->nombre}}</td>
					<td>{{$item->tipo}}</td>
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