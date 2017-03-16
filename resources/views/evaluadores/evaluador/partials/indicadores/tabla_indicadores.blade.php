<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Tipo</th>	
			<th>Orden</th>	

		<tbody>
		@foreach($indicadoresDisponibles as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->tipo}}</td>
				<td>{{$item->orden}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>