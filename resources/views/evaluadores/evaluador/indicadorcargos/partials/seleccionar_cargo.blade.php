

  <div class="row panel-body">
	<div class="content">
		<div class="row col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
				  <p class="titulo-panel">Seleccionar Cargo</p>
				</div>
				<div class="panel-body">
					@include('evaluadores/evaluador/indicadorcargos/partials/tabla_cargos')
				</div>
			</div>
		</div>

		<div class="col-sm-8">
      		<p class="titulo-panel">Cargos asignados</p><br>
			@include('evaluadores/evaluador/indicadorcargos/partials/tabla_agregados')
		</div>


	</div>
      
  </div>








