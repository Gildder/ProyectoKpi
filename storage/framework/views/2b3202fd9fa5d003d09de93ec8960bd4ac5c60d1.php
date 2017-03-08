<?php $__env->startSection('titulo'); ?>
	Gerencia Evaluadora Cargos
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">Lista de Indicadores</p>

  </div>
  <div class="panel-body">
  	
	<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="row">
		<div class="col-lg-12">
			<?php echo $__env->make('indicadores/indicadorCargos/partials/tabla_indicadorcargos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>

  </div>
  <div class="panel-footer">
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>