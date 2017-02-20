<div class="table-response">
	<table  id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Grupo Departamento</th>	
			<th>Opciones</th>
		</thead>

		<tbody>
		@foreach($departamentos as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->grupo}}</td>
				<td>
					<a href="#" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#modal-restaurar-{{$item->id}}"><span class="fa fa-check"  title="Eliminar"></span><b > Restaurar</b></a>
				</td>
			</tr>
			@include("localizaciones/departamento/restaurar")
		@endforeach
		</tbody>

	</table>
</div>