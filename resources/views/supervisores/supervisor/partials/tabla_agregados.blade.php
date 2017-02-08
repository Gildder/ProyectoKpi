<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre</th>	
			<th>Cargo</th>	
			<th></th>	
		</thead>

		<tbody>
			@foreach($empleadosup as $item)
			<tr>
				<td>{{$item->codigo}}</td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>{{$item->cargo}}</td>
				<td>
					<a href="{{route('supervisores.supervisor.quitardepartamento', array($item->codigo, $departamento->id)) }}" class="btn btn-danger btn-xs" ><span class="fa fa-trash"  title="Quitar"></span></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>



