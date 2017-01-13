<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Tipo</th>	
			<th>Orden</th>	
			<th>Objetivo</th>	
			<th>Condicion</th>	
			<th>Frecuencia</th>	
		</thead>

		<tbody>
		@foreach($indicadores as $indicador)
			<tr>
				<td><a href="{{route('indicadores.indicador.show', $indicador->id)}}" class="btn btn-primary btn-xs" ><span >{{$indicador->id}}</span></a></td>
				<td>{{$indicador->nombre}}</td>
				<td>{{$indicador->tipo}}</td>
				<td>{{$indicador->orden}}</td>
				<td>{{$indicador->descripcion_objetivo}} {{$indicador->objetivo}} %</td>
				<td>{{$indicador->condicion}}</td>
				<td>{{$indicador->frecuencia}}</td>
			</tr>
    		@include('empleados/empleado/partials/ver_indicador')

		@endforeach
		</tbody>

	</table>
</div>