<div class="table-response">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
		</thead>

		<tbody>
		@foreach($escalas as $escala)
			<tr>
				<td><a href="{{route('evaluadores.escala.show', $escala->id )}}" class="btn btn-warning btn-xs" ><span class=""  title="Eliminar"></span><span >{{$escala->id}}</span></a></td>
				<td>{{$escala->nombre}}</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>