<?php $__env->startSection('titulo'); ?>
	<?php echo e($evaluador->id); ?> - <?php echo e($evaluador->abreviatura); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel"><?php echo e($evaluador->abreviatura); ?> - <?php echo e($evaluador->descripcion); ?></p>
	</div>

	<div class="panel-body">

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#evaluadores">Evaluadores</a></li>
		</ul>

		<div class="tab-content">
			<div id="evaluadores" class="tab-pane fade in active">
				<div class="col-lg-12 breadcrumb">
					<a href="<?php echo e(route('empleados.evaluadorempleados.index')); ?>" class="btn btn-primary btn-xs" title="Volver"><span class="fa fa-reply"></span></a>
				</div>
				

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<p>Elige a los empleados que seran evaluadores de Gerencia.</p><hr>
					</div>

					<?php /* Capa de Seleccion Empleado */ ?>
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

					<?php /* Capa de empleados Agregados */ ?>
					<div class="col-sm-5">
							<p class="titulo-panel">Evaluadores </p><br>
						<?php echo $__env->make('empleados/evaluadorempleados/partials/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
				</div>
			</div>
		</div>
		<!-- Fin Panel Tab -->

	</div>
	<div class="panel-footer">
	</div>
		
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>