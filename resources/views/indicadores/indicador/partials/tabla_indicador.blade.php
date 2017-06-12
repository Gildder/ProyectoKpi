<div class="table-responsive">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Descripcion</th>	
			<th>Tipo</th>	
			<th>Orden</th>	
		</thead>

		<tbody>
		@foreach($indicadores as $indicador)
			<tr>
				<td><a href="{{route('indicadores.indicador.show', $indicador->id)}}" class="btn btn-warning btn-xs" ><span >{{$indicador->id}}</span></a></td>
				<td>{{$indicador->nombre}}</td>
				<td>{{$indicador->descripcion}}</td>
				<td>{{$indicador->tipo}}</td>
				<td>{{$indicador->orden}}</td>
				
			</tr>
    		@include('indicadores/indicador/delete')
		@endforeach
		</tbody>

	</table>
</div>