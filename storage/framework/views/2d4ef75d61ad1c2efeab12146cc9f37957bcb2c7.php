

  <div class="panel-body">
	<div class="content">
		<div class="col-sm-8">
      		<p class="titulo-panel">Cargos asignados</p><br>
			<?php echo $__env->make('indicadores/indicadorcargos/partials/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>

		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
				  <p class="titulo-panel">Seleccionar Cargo</p>
				</div>
				<div class="panel-body">
					<?php echo $__env->make('indicadores/indicadorcargos/partials/tabla_cargos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>

	</div>
      
  </div>








