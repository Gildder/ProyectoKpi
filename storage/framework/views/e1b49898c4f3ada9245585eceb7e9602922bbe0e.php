<?php $__env->startSection('titulo'); ?>
	<?php echo e($cargo->id); ?> - <?php echo e($cargo->nombre); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
	 <a href="<?php echo e(route('empleados.cargo.index')); ?>" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel"><?php echo e($cargo->id); ?> - <?php echo e($cargo->nombre); ?></p>
	</div>

	<div class="panel-body">
		<div id="datos" class="tab-pane fade in active">
			<div class="content col-sm-6">

					<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<?php echo $__env->make('empleados/cargo/partials/datos_cargo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	

				<?php echo $__env->make("empleados/cargo/delete", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>

	</div>
	<div class="col-sm-12 panel-footer text-right">

		<a href="<?php echo e(route('empleados.cargo.edit', $cargo->id)); ?>" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
		<a href="#"  data-toggle="modal" data-target="#modal-delete-<?php echo e($cargo->id); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>

	</div>
		
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>