<?php $__env->startSection('titulo'); ?>
	Nuevo Supervisor
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
  <div class="panel-heading">
	<a href="<?php echo e(route('supervisores.supervisor.index')); ?>" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>

      <p class="titulo-panel"><?php if($tipo == 0): ?> Cargo <?php else: ?> Departamento <?php endif; ?> <?php echo e($lista->id); ?>: <?php echo e($lista->nombre); ?></p>
      
  </div>
  <div class="panel-body">
	<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>


	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<p>Elije a los empleados que supervisaran el <?php if($tipo == 0): ?> cargo <?php else: ?> departamento <?php endif; ?> <b><?php echo e($lista->nombre); ?></b>.</p><br>
	</div>

	<div class="col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">
			  <p class="titulo-panel">Seleccionar Empleado</p>
			</div>
			<div class="panel-body">
				<?php echo $__env->make('supervisores/supervisor/partials/tabla_empleados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	</div>

	<div class="col-sm-4">
  		<p class="titulo-panel">Supervisores</p><hr>
		<?php echo $__env->make('supervisores/supervisor/partials/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
      
  </div>
  <div class="panel-footer text-right">
  </div>


</div>

<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>