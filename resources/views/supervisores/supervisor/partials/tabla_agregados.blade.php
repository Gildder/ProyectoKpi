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
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-deleteCargoSupervisor-{{ $item->codigo }}"  class="btn btn-danger btn-xs" ><span class="fa fa-trash"  title="Quitar"></span></a>
					@else
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-deleteDepartamentoSupervisor-{{ $item->codigo }}" class="btn btn-danger btn-xs" ><span class="fa fa-trash"  title="Quitar"></span></a>
					@endif
				</td>
			</tr>
			@include('supervisores/supervisor/partials/deleteCargo')
			@include('supervisores/supervisor/partials/deleteDepartamento')

			@endforeach
		</tbody>
	</table>
</div>



