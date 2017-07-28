<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre</th>	
			<th>Cargo</th>	
			<th>Localizacion</th>	
			<th>Departamento</th>	
			<th></th>	
		</thead>

		<tbody>
		@foreach($empleadosDisponibles as $item)
			<tr>
				<td><a href="#" class="btn btn-warning btn-xs"  title="Ver"><span >{{$item->codigo}}</span></a></td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>{{$item->cargo}}</td>
				<td>{{$item->localizacion}}</td>
				<td>{{$item->departamento}}</td>
				<td>
					<a href="{{route('supervisores.supervisados.show', $item->id)}}" class="btn btn-info btn-xs" title="Ver Indicadores"><span class="fa fa-bar-chart"></span><span ></span></a>
				</td>
				
			</tr>
		@endforeach
		</tbody>

	</table>
</div>
