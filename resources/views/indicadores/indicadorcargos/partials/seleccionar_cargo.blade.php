

  <div class="panel-body">
	<div class="content">
		<div class="col-sm-8">
      		<p class="titulo-panel">Cargos asignados</p><br>
			@include('indicadores/indicadorcargos/partials/tabla_agregados')
		</div>

		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
				  <p class="titulo-panel">Seleccionar Cargo</p>
				</div>
				<div class="panel-body">
					@include('indicadores/indicadorcargos/partials/tabla_cargos')
				</div>
			</div>
		</div>

	</div>
      
  </div>








