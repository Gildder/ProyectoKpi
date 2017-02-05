<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Objetivo</th>	
			<th>Frecuencia</th>	
			<th></th>	
		</thead>

		<tbody>
			@foreach($cargosEvaluadores as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->objetivo}} %</td>
				<td>{{$item->frecuencia}}</td>
				<td>
					<a href="{{ route('indicadores.indicadorcargos.editar', array($item->id, $indicador->id)) }}" class="btn btn-warning btn-sm" title="Editar"><span class="fa fa-edit" ></span></a>
					<a href="#" data-toggle="modal" data-target="#modal-delete-{{$item->id}}" class="btn btn-danger btn-sm" ><span class="fa fa-trash"  title="Quitar Cargo"></span></a>
				</td>
			</tr>
				@include('indicadores/indicadorcargos/delete')
			@endforeach
		</tbody>
	</table>
</div>

