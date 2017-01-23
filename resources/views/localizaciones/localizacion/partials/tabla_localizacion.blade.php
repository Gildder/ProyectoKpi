<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Direccion</th>	
			<th>Telefono</th>	
			<th>Grupo Localizacion</th>	
			<th>Opciones</th>
		</thead>

		<tbody>
		@foreach($localizaciones as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->direccion}}</td>
				<td>{{$item->telefono}}</td>
				<td>{{$item->grupo}}</td>
				<td>
					<a href="{{route('localizaciones.localizacion.edit', $item->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-edit"   title="Editar"></span><b> Editar</b></a>
					<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-{{$item->id}}" ><span class="fa fa-trash"  title="Eliminar"></span><b> Borrar</b></a>
				</td>
			</tr>
			@include("localizaciones/departamento/delete")
		@endforeach
		</tbody>

	</table>
</div>