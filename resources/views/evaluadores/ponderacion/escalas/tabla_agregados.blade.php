<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Minimo %</th>	
			<th>Maximo %</th>	
			<th></th>	
		</thead>

		<tbody>
			@foreach($escalasAgregados as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->minimo}}</td>
				<td>{{$item->maximo}}</td>
				<td>
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-deleteEscala-{{$item->id}}"  class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash"  title="Quitar Escala"></span></a>
				</td>
			</tr>
     			@include('evaluadores/ponderacion/escalas/delete')

			@endforeach
		</tbody>
	</table>
</div>

