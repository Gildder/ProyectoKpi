<?php $__env->startSection('titulo'); ?>
	<?php echo e($indicador->nombre); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel"><?php echo e($indicador->id); ?> - <?php echo e($indicador->nombre); ?></p>
	</div>

	<div class="panel-body">

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#cargos">Cargos Asignados</a></li>
		</ul>

		<div class="tab-content">
			<div id="cargos" class="tab-pane fade in active">
				<div class="col-lg-12 breadcrumb">
					<a href="<?php echo e(route('indicadores.indicador.index')); ?>" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
				</div>

				<div class="col-lg-12">
					<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>

				<div class="row content">
					<?php echo $__env->make('indicadores/indicadorcargos/partials/seleccionar_cargo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
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