<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel"><?php echo e($indicador->nombre); ?></p>
	</div>
	<div class="panel-body">
		<?php /* <?php echo $__env->make('supervisores/supervisor/partials/tabla_empleados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> */ ?>

		<div class="col-sm-6">
			<h3>Tabla</h3>
			<div>
				<?php echo $__env->make('partials/indicadores/primer_indicador/tabla_primerIndicador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
		<div class="col-sm-6">
			<h2>Grafica</h2>
			<div>
				<?php echo $__env->make('partials/indicadores/primer_indicador/grafico_primerIndicador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	</div>
</div>