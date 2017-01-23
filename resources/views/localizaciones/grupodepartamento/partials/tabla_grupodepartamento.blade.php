<div class="table-response">
	<table id="myTableGrDepartamento" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th >Acciones</th>
		</thead>

		<tbody>
		@foreach($grupodepartamentos as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>
					<a href="{{route('localizaciones.grupodepartamento.edit', $item->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-edit"   title="Editar"></span> <b>Editar</b> </a>
					<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-{{$item->id}}"><span class="fa fa-trash"  title="Eliminar"></span> <b>Borrar</b> </a>
				</td>
			</tr>
			
			@include("localizaciones/grupodepartamento/delete")
		@endforeach
		</tbody>

	</table>
</div>