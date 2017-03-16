<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Codigo</th>
			<th>Nombre</th>	
			<th></th>	
		</thead>

		<tbody>
			@foreach($empleadosup as $item)
			<tr>
				<td>{{$item->codigo}}</td>
				<td>{{$item->nombres}} {{$item->apellidos}}</td>
				<td>
					@if($tipo == 0)
					<a href="{{route('supervisores.supervisor.quitarcargo', array($item->codigo, $lista->id)) }}" class="btn btn-danger btn-xs" ><span class="fa fa-trash"  title="Quitar"></span></a>
					@else
					<a href="{{route('supervisores.supervisor.quitardepartamento', array($item->codigo, $lista->id)) }}" class="btn btn-danger btn-xs" ><span class="fa fa-trash"  title="Quitar"></span></a>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>



