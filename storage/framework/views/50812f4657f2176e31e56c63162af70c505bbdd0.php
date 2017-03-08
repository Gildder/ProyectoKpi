<div class="col-sm-7">
	<div class="panel panel-default">
		<div class="panel-heading">
		  <p class="titulo-panel">Selecciona Empleado</p>
		</div>
		<div class="panel-body">
			<?php echo $__env->make('empleados/evaluadorempleados/partials/tabla_empleados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
</div>

<div class="col-sm-5">
		<p class="titulo-panel">Empleados Agregados </p><br>
	<?php echo $__env->make('empleados/evaluadorempleados/partials/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>









