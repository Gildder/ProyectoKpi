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
				<td data-id="{{$indicador->id}}"><a id="ver-indicador" href="#" class="btn btn-primary btn-xs" data-id="{{$indicador->id}}" >
					<span class=""</span><span >{{$indicador->id}}</span></a>
				</td>
				<td data-orden="{{$indicador->orden}}" >{{$indicador->orden}}</td>
				<td data-nombre="{{$indicador->nombre}}">{{$indicador->nombre}}</td>
				<td data-tipo="{{$indicador->tipo_indicador_id}}">{{$indicador->tipo_indicador_id}}</td>
				<td data-objetivo="{{$indicador->descripcion_objetivo}} {{$indicador->objetivo}}">{{$indicador->descripcion_objetivo}} {{$indicador->objetivo}} %</td>
				<td data-condicion="{{$indicador->condicion}}">{{$indicador->condicion}}</td>
				<td data-frecuencia="{{$indicador->frecuencia}}">{{$indicador->frecuencia}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>