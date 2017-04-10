<div class="">
	<table class="table table-striped table-bordered table-condensed table-hover table-response">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Ponderacion %</th>	
			<th></th>	
		</thead>

		<tbody>
			@foreach($indicadoresAgregados as $item)
			<tr>
				<td>{{$item->id}}</td>
				<td>{{$item->nombre}}</td>
				<td>{{$item->ponderacion}}</td>
				<td>
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-deleteIndicadorPonderacion-{{$item->id}}"  class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash"  title="Quitar Indicador"></span></a>
				</td>
			</tr>
     			@include('evaluadores/ponderacion/indicadores/delete')

			@endforeach
		</tbody>
	</table>
</div>

