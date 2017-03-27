<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Tipo</th>	
			<th>Objetivo</th>	
			<th>Cagos Asignados</th>	
			<th></th>
		</thead>

		<tbody>
			@foreach($indicadores as $item)
				<tr>
					<td><a href="#" class="btn btn-warning btn-xs" >{{$item->id}}</a></td>
					<td>{{$item->nombre}}</td>
					<td>{{$item->tipo}}</td>
					<td>{{$item->descripcion}}</td>
					<td> 
						@foreach($item->getCargos($item->id) as $cargo)
							{{ $cargo->nombre }} <br>
						@endforeach
					</td>
					<td><a href="{{route('evaluadores.evaluador.indicadorcargos.show', $item->id) }}" class="btn btn-info btn-xs" title="Indicador por Cargo"><span class="fa fa-sitemap"></span></a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>