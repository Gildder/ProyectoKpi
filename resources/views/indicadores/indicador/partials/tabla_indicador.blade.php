<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Descripcion</th>	
			<th>Tipo</th>	
			<th>Orden</th>	
			<th>Cargos Asignados</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($indicadores as $indicador)
			<tr>
				<td><a href="{{route('indicadores.indicador.show', $indicador->id)}}" class="btn btn-warning btn-xs" ><span >{{$indicador->id}}</span></a></td>
				<td>{{$indicador->nombre}}</td>
				<td>{{$indicador->descripcion}}</td>
				<td>{{$indicador->tipo}}</td>
				<td>{{$indicador->orden}}</td>
				<td>
					<ul>
					@foreach($indicador->getCargos($indicador->id) as $value)
					<li>{{ $value->nombre }} </li>
					@endforeach
					</ul>
				</td>
				<td><a href="{{route('indicadores.indicadorcargos.show', $indicador->id)}}" class="btn btn-info btn-xs" title="Agregar Cargos"><span class="fa fa-sitemap"></span></a></td>

			</tr>
    		@include('indicadores/indicador/delete')
		@endforeach
		</tbody>

	</table>
</div>