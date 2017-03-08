<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
			@foreach($cargosup as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>
					<a href="{{route('empleados.evaluador.quitarcargo', array($item->id, $evaluador->id)) }}" class="btn btn-danger btn-xs" ><span class="fa fa-trash"  title="Quitar Cargo"></span></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

