

  <div class="panel-body">
	<div class="content">

		<div class="row col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
				  <p class="titulo-panel">Selecciona Cargo</p>
				</div>
				<div class="panel-body">
					<?php echo $__env->make('empleados/evaluadorcargos/partials/tabla_cargos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>

		<div class="col-sm-6">
      		<p class="titulo-panel">Cargos Agregados </p><br>
			<?php echo $__env->make('empleados/evaluadorcargos/partials/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
      
  </div>








