<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Ponderacion %</th>	
			<th></th>	
		</thead>

		<tbody>
			@foreach($tiposAgregados as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->ponderacion}}</td>
				<td>
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-deleteTipoIndicadorPonderacion-{{$item->id}}"  class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash"  title="Quitar Tipo"></span></a>
				</td>
			</tr>
     			@include('evaluadores/ponderacion/tipos/delete');
			@endforeach
		</tbody>
	</table>
</div>

