<table id="myTableFiltro" class="table table-striped table-bordered table-condensed table-hover">
	<thead>
		<tr>
			<th>Nro</th>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Departamento</th>
			<th>Usuario</th>
			<th>Correo</th>
			<th>Cargo</th>
			<th>Gerencia Evaluadora</th>
			<th></th>
		</tr>
	</thead>
	{{--<tfoot style="display: table-header-group;" >--}}
		{{--<th>Nro</th>--}}
		{{--<th>Nombres</th>	--}}
		{{--<th>Apellidos</th>	--}}
		{{--<th>Departamento</th>	--}}
		{{--<th>Usuario</th>	--}}
		{{--<th>Correo</th>	--}}
		{{--<th>Cargo</th>	--}}
		{{--<th>Gerencia Evaluadora</th>	--}}
	{{--</tfoot>--}}

	<tbody>
	@foreach($evaluados as $item)
		<tr>
			<td>{{$item->codigo}}</td>
			<td>{{$item->nombres}}</td>
			<td>{{$item->apellidos}}</td>
			<td>{{$item->departamento}}</td>
			<td>{{$item->usuario}}</td>
			<td>{{$item->correo}}</td>
			<td>{{$item->cargo}}</td>
			<td>{{$item->gerencia}}</td>
			<td><a  href="{{ route('evaluadores.evaluados.misevaluados.show',$item->codigo)}}"  class="btn btn-linkedin btn-xs" title="Ver Indicador"><span class="fa fa-bar-chart"></span></a></td>
		</tr>
	@endforeach
	</tbody>

</table>
