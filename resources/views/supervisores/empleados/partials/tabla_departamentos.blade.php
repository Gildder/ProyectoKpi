<div class="table-response">
	<table  id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Departamento</th>	
			<th>Supervisor</th>	
		</thead>

		<tbody>
		@foreach($departamentos as $item)
			<tr>
				<td><a href="{{route('supervisores.departamentos.show', $item->id)}}" class="btn btn-primary btn-xs" class="btn btn-primary btn-xs" ><span >{{$item->id}}</span></a></td>
				<td>{{$item->nombre}}</td>
				<td>gildder</td>
			</tr>
			@include("localizaciones/departamento/delete")
		@endforeach
		</tbody>

	</table>
</div>