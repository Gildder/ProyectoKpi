<div class="table-responsive">
	<table id="myTable" class="table  table-striped table-bordered table-condensed table-hover">
		<thead>
			<th>Conexion</th>
			<th>Habilitado</th>
			<th>Sincronizar Ahora</th>
		</thead>

		<tbody>
		@foreach($conexiones as $conexion)
			<tr>
				<td>
                    {!! $conexion->nombre !!}
                </td>
				<td>{!! $conexion->habiltiado !!}</td>
				<td>
                    <a  href="#" class="@lang('labels.stylbtns.btnRestaurar')" >
                        <span class="@lang('labels.icons.icoBtnRestaurar')"
                              title="Restaurar"></span><span >  @lang('labels.buttons.btnRestaurar')</span></a>
                </td>
			</tr>
		@endforeach
		</tbody>

	</table>
</div>
