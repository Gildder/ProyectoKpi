<?php $__env->startSection('titulo'); ?>
	Supervisores
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
      		<p class="titulo-panel" style="display: inline-block;">Supervisores</p>
			<a href="#" title="Informacion" class="btn btn-primary btn-xs pull-right"><span class="fa fa-info"></span></a>
		</div>
		<div class="panel-body">

			<!--panelTab -->
			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#departamentos">Departamentos</a></li>
			  <li><a data-toggle="tab" href="#cargos">Cargos</a></li>
			</ul>
			<br>

			
			<div class="tab-content">
				<div id="departamentos" class="tab-pane fade in active">
					<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<p>Puede agregar empleados que supervisen los indicadores por departamentos.</p><br>
					</div>

						<div class="row">
							<div class="col-lg-12">
					        	<?php echo $__env->make("supervisores/supervisor/partials/tabla_departamentos", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</div>
						</div>
				</div>

				<div id="cargos" class="tab-pane">
					<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<p>Puede agregar empleados que supervisen los indicadores por cargo o puesto.</p><br>
					</div>

					<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
			        	<?php echo $__env->make("supervisores/supervisor/partials/tabla_cargos", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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