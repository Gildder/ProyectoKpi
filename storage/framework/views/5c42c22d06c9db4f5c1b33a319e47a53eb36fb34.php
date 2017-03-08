<?php $__env->startSection('titulo'); ?>
	<?php echo e($evaluador->abreviatura); ?> <?php echo e($evaluador->descripcion); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel"><?php echo e($evaluador->id); ?> - <?php echo e($evaluador->abreviatura); ?>: <?php echo e($evaluador->descripcion); ?></p>
	</div>

	<div class="panel-body">

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#cargos">Cargos Evaluados</a></li>
		</ul>

		<div class="tab-content">
			<div id="cargos" class="tab-pane fade in active">
				<div class="col-lg-12 breadcrumb">
					<a href="<?php echo e(route('empleados.evaluadorcargos.index')); ?>" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
				</div>

				<div class="content">
					<?php echo $__env->make('empleados/evaluadorcargos/partials/seleccionar_cargo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
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