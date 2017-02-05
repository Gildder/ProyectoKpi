

  <div class="panel-body">
	<div class="content">

		<div class="row col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
				  <p class="titulo-panel">Selecciona Cargo</p>
				</div>
				<div class="panel-body">
					@include('empleados/evaluadorcargos/partials/tabla_cargos')
				</div>
			</div>
		</div>

		<div class="col-sm-6">
      		<p class="titulo-panel">Cargos Agregados </p><br>
			@include('empleados/evaluadorcargos/partials/tabla_agregados')
		</div>
	</div>
      
  </div>








