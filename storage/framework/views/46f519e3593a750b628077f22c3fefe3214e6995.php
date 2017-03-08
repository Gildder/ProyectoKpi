<?php $__env->startSection('titulo'); ?>
	Evaluadores
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="panel panel-default">
  <div class="panel-heading">
  	<p class="titulo-panel">Evaluadores de Gerencia</p>
  </div>
  <div class="panel-body">
  	
	<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	 <?php if($evaluadores->count()<= 0): ?>
	    <p>Por favor, Para usar esta opcion primero crear una <a href="<?php echo e(route('empleados.evaluador.index')); ?>">Gerencia Evaluadora</a> .</p><br>
	   <?php endif; ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<p>Lista de Gerencia Evaluadores.</p><hr>
			</div>
			<?php echo $__env->make('empleados/evaluadorempleados/partials/tabla_evaluadorempleados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>

  </div>
  <div class="panel-footer">
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>