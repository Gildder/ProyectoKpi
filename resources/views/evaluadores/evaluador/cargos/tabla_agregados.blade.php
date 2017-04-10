<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
			@foreach($cargoAgregados as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-deleteCargoEvaluador-{{$evaluador->id}}" class="btn btn-danger btn-xs" ><span class="fa fa-trash"  title="Quitar Cargo"></span></a>
				</td>
			</tr>
			@include('evaluadores/evaluador/cargos/delete')

			@endforeach
		</tbody>
	</table>
</div>

