
  <div class="panel-body">
	<div class="content">
		
		<div class="row col-sm-7">
			<div class="panel panel-default">
				<div class="panel-heading">
				  <p class="titulo-panel">Selecciona Empleado</p>
				</div>
				<div class="panel-body">
					@include('empleados/evaluadorempleados/partials/tabla_empleados')
				</div>
			</div>
		</div>

		<div class="col-sm-5">
      		<p class="titulo-panel">Empleados Agregados </p><br>
			@include('empleados/evaluadorempleados/partials/tabla_agregados')
		</div>
	</div>
      
  </div>








