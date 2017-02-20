<div class="table-response">
	<table  id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Opciones</th>
		</thead>

		<tbody>
		@foreach($grupolocalizaciones as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>
					<a href="#" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#modal-restaurar-{{$item->id}}"><span class="fa fa-check"  title="Eliminar"></span><b > Restaurar</b></a>
				</td>
			</tr>
			@include("localizaciones/grupolocalizacion/restaurar")
		@endforeach
		</tbody>

	</table>
</div>