<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Abreviatura</th>	
			<th>Descripcion</th>	
		</thead>

		<tbody>
		@foreach($evaluadores as $item)
			<tr>
				<td><a href="{{route('empleados.evaluador.show', $item->id)}}" class="btn btn-warning btn-xs" >{{$item->id}}</a></td>
				<td>{{$item->abreviatura}}</td>
				<td>{{$item->descripcion}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>