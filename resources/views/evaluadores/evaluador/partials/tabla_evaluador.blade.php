
<table id="myTableEvaluador" class="table table-striped table-bordered table-condensed table-hover">
	<thead>
		<th>Nro</th>
		<th>Abreviatura</th>
		<th>Descripcion</th>
		<th>Ponderacion</th>
	</thead>

	<tbody>
	@foreach($evaluadores as $item)
		<tr>
			<td><a href="{{route('evaluadores.evaluador.show', $item->id)}}" @click="mostrarModalLoading()"  class="btn btn-warning btn-xs" title="Ver">{{$item->id}}</a></td>
			<td>{{$item->abreviatura}}</td>
			<td>{{$item->descripcion}}</td>
			<td>{{$item->ponderacion->nombre}}</td>
		</tr>
	@endforeach
	</tbody>

</table>
