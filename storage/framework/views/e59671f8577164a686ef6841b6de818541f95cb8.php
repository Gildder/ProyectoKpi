<?php $__env->startSection('titulo'); ?>
	Nuevo Supervisor
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel"><?php echo e($departamento->id); ?> - <?php echo e($departamento->nombre); ?></p>
      
  </div>
  <div class="panel-body">

	<div class="content">
		<div class="col-lg-12 breadcrumb">
			<a href="<?php echo e(route('supervisores.supervisor.index')); ?>" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
		</div>
		
		<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
				  <p class="titulo-panel">Seleccionar Empleado</p>
				</div>
				<div class="panel-body">
					<?php echo $__env->make('supervisores/supervisor/partials/tabla_empleados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>

		<div class="col-sm-6">
      		<p class="titulo-panel">Encargados - <?php echo e($departamento->nombre); ?></p><br>
			<?php echo $__env->make('supervisores/supervisor/partials/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
      
  </div>
  <div class="panel-footer text-right">
  </div>


</div>

<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>