<?php $__env->startSection('titulo'); ?>
      Grupo Localizacion
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
	<div class="panel-heading">
  		<p class="titulo-panel">Grupo Localizacion</p>

	</div>
	<div class="panel-body">
		
		<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<div class="text-left col-lg-12 breadcrumb">
			<a  href="<?php echo e(route('localizaciones.grupolocalizacion.create')); ?>" class="btn btn-primary btn-sm" ><span class="fa fa-plus">  </span><b>   Nuevo</b> </a>
		</div>
		<div class="row">
			<div class="col-lg-12">
	        	<?php echo $__env->make("localizaciones/grupolocalizacion/partials/tabla_grupolocalizacion", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>

	</div>
	<div class="panel-footer">
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>