<div class="table-response">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Id</th>
			<th>Usuario</th>
			<th></th>
		</thead>

		<tbody>
			@foreach($empleadosup as $item)
			<tr>
				<td>{{ $item->id }}</td>
				<td>{{ $item->usuario }}</td>
				<td>
					@if($tipo == 0)
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-deleteCargoSupervisor-{{ $item->id }}"  class="btn btn-danger btn-xs" ><span class="fa fa-trash"  title="Quitar"></span></a>
					@else
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-deleteDepartamentoSupervisor-{{ $item->id }}" class="btn btn-danger btn-xs" ><span class="fa fa-trash"  title="Quitar"></span></a>
					@endif
				</td>
			</tr>
			@include('supervisores/supervisor/partials/deleteCargo')
			@include('supervisores/supervisor/partials/deleteDepartamento')

			@endforeach
		</tbody>
	</table>
</div>



