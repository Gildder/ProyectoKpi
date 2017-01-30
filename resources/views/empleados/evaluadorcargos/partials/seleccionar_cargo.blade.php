

  <div class="panel-body">
	<div class="content">
		<div class="col-sm-4">
      		<p class="titulo-panel">Empleados asignados - {{$evaluador->abreviatura}}</p><br>
			@include('empleados/evaluadorcargos/partials/tabla_agregados')
		</div>

		<div class="col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
				  <p class="titulo-panel">Seleccionar Empleado</p>
				</div>
				<div class="panel-body">
					@include('empleados/evaluadorcargos/partials/tabla_cargos')
				</div>
			</div>
		</div>

	</div>
      
  </div>








