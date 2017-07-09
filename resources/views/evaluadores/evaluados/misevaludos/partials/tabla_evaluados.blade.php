<table id="myTableFiltro" class="table table-striped table-bordered table-condensed table-hover">
	<thead>
		<tr>
			<th>Nro</th>
			<th>Usuario</th>
			<th>codigo</th>
			<th>Nombre </th>
			<th>Departamento</th>
			<th>Correo</th>
			<th>Cargo</th>
			<th>Gerencia Evaluadora</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	@foreach($evaluados as $item)
		<tr>
			<td>{{$item->id}}</td>
			<td>{{$item->usuario}}</td>
			<td>{{$item->codigo}}</td>
			<td>{{$item->nombres}} {{$item->apellidos}}</td>
			<td>{{$item->departamento}}</td>
			<td>{{$item->correo}}</td>
			<td>{{$item->cargo}}</td>
			<td>{{$item->gerencia}}</td>
			<td><a  href="{{ route('evaluadores.evaluados.misevaluados.show',$item->id)}}"  class="btn btn-linkedin btn-xs" title="Ver Indicador"><span class="fa fa-bar-chart"></span></a></td>
		</tr>
	@endforeach
	</tbody>

</table>
