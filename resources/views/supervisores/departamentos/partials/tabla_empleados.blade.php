<div class="table-response">
	<table id="myTable" class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre Completo</th>	
			<th>Cargo</th>	
			<th>Localizaciones</th>	
			<th>Departamentos</th>	
			<th>Opciones</th>	
		</thead>

		<tbody>
		@foreach($empleadosdis as $item)
			<tr>
				<td>{{$item->codigo}}</td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>{{$item->cargo}}</td>
				<td>{{$item->localizacion}}</td>
				<td>{{$item->departamento}}</td>
				<td>
					<a href="{{route('supervisores.departamentos.agregardepartamento', array($item->codigo, $departamento->id)) }}"  class="btn btn-primary btn-sm">Agregar</a>
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>