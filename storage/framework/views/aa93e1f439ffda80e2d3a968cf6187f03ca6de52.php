<?php $__env->startSection('titulo'); ?>
	Supervisores
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
      		<p class="titulo-panel">Supervisiones</p>

		</div>
		<div class="panel-body">

			<!--panelTab -->
			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#datos">Departamentos</a></li>
			</ul>
			
			<br>
			<div class="tab-content">
				<div id="datos" class="tab-pane fade in active">
					<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<div class="row">
						<div class="col-lg-12">
				        	<?php echo $__env->make("supervisores/supervisor/partials/tabla_departamentos", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
					</div>
				</div>
				<!-- Fin Panel Tab -->
			</div>
		</div>
		<div class="panel-footer">
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>