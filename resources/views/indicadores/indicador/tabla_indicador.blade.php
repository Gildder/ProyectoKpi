<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Orden</th>	
			<th>Nombre</th>	
			<th>Tipo</th>	
			<th>Objetivo</th>	
			<th>Condicion</th>	
			<th>Frecuencia</th>	
		</thead>

		<tbody>
		@foreach($indicadores as $indicador)
			<tr>
				<td><a href="{{route('indicadores.indicador.edit', $indicador->id)}}" class="btn btn-primary btn-xs" ><span class=""  title="Baja"></span><span >{{$indicador->id}}</span></a></td>
				<td>{{$indicador->orden}}</td>
				<td>{{$indicador->nombre}}</td>
				<td>{{$indicador->tipo_indicador_id}}</td>
				<td>{{$indicador->descripcion_objetivo}} {{$indicador->objetivo}} %</td>
				<td>{{$indicador->condicion}}</td>
				<td>{{$indicador->frecuencia}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>