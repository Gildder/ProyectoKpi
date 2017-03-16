
<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Descripcion</th>	
		</thead>

		<tbody>
		@foreach($ponderaciones as $item)
			<tr>
				<td><a href="{{route('evaluadores.ponderacion.show', $item->id)}}" class="btn btn-warning btn-xs" title="Ver">{{$item->id}}</a></td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->descripcion}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>