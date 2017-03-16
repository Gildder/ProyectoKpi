<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
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
				<td>{{$item->nombres}}</td>
				<td>{{$item->ponderacion}}</td>
				<td>
					<a href="{{route('evaluadores.ponderacion.quitarindicador', array($item->id, $ponderacion->id)) }}" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash"  title="Quitar Indicador"></span></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

