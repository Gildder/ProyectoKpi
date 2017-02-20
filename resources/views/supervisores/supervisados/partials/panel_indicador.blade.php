<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel">{{$indicador->nombre}}</p>
	</div>
	<div class="panel-body">
		{{-- @include('supervisores/supervisor/partials/tabla_empleados') --}}

		<div class="col-sm-6">
			<h3>Tabla</h3>
			<div>
				@include('partials/indicadores/primer_indicador/tabla_primerIndicador')
			</div>
		</div>
		<div class="col-sm-6">
			<h3>Grafica</h3>
			<div>
				@include('partials/indicadores/primer_indicador/grafico_primerIndicador')
			</div>
		</div>
	</div>
</div>