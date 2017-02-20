<div class="table-response">
	<table  id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Grupo Localizacion</th>	
			<th>Opciones</th>
		</thead>

		<tbody>
		@foreach($localizaciones as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->grupo}}</td>
				<td>
					<a href="#" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#modal-restaurar-{{$item->id}}"><span class="fa fa-check"  title="Eliminar"></span><b > Restaurar</b></a>
				</td>
			</tr>
			@include("localizaciones/localizacion/restaurar")
		@endforeach
		</tbody>

	</table>
</div>