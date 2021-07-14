<div class="table-responsive">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Nro</th>
			<th>Nombre</th>	
			<th>Descripcion</th>
			<th></th>
		</thead>

		<tbody>
		@foreach($estados as $estado)
			<tr>
				<td>{{$estado->id}}</td>
				<td>
                    <input class="estiloEstado" style="background-color: {!! $estado->color !!}; color: {!! $estado->texto !!};" value="{!! $estado->nombre !!}" readonly="true">
                </td>
				<td>{{$estado->descripcion}}</td>
				<td><a  href="#"  data-toggle="modal" data-target="#modal-restaurar-{{$estado->id}}"  class="@lang('labels.stylbtns.btnRestaurar')" ><span class="@lang('labels.icons.icoBtnRestaurar')"  title="Restaurar"></span><span >  @lang('labels.buttons.btnRestaurar')</span></a></td>
			</tr>
			@include("estados/tareas/restaurar")

		@endforeach
		</tbody>

	</table>
</div>
