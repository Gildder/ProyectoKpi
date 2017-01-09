<div class="table-response">
	<table  id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Departamento</th>	
			<th>Grupo</th>	
			<th>Opciones</th>
		</thead>

		<tbody>
		@foreach($departamentos as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->departamento}}</td>
				<td>{{$item->grupo}}</td>
				<td>
					<a href="{{route('localizaciones.departamento.edit', $item->id)}}" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"   title="Editar"></span><span > Editar</span></a>
					<a href="#" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-delete-{{$item->id}}"><span class="glyphicon glyphicon-trash"  title="Eliminar"></span><span > Eliminar</span></a>
				</td>
			</tr>
			@include("localizaciones/departamento/delete")
		@endforeach
		</tbody>

	</table>
</div>