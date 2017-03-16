<?php $__env->startSection('titulo'); ?>
	<?php echo e($evaluador->id); ?> - <?php echo e($evaluador->abreviatura); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
	  <a href="<?php echo e(route('evaluadores.evaluador.index')); ?>" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
	  <p class="titulo-panel"><?php echo e($evaluador->abreviatura); ?> - <?php echo e($evaluador->descripcion); ?></p>
	</div>

	<div class="panel-body">

  		<?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
		  <li ><a data-toggle="tab" href="#evaluadores">Evaluadores</a></li>
		  <li ><a data-toggle="tab" href="#cargos">Cargos</a></li>
		</ul>

		<div class="tab-content">
			<div id="datos" class="tab-pane fade in active">
				<div class="content col-sm-6">

					<?php echo $__env->make('evaluadores/evaluador/partials/datos_evaluador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	

					<?php echo $__env->make("evaluadores/evaluador/delete", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				<div class="col-sm-12 panel-footer text-right">
					<a href="<?php echo e(route('evaluadores.evaluador.edit', $evaluador->id)); ?>" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
					<a href="#"  data-toggle="modal" data-target="#modal-delete-<?php echo e($evaluador->id); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>
				</div>
			</div>

			<?php /* Evaluadores */ ?>
			<div id="evaluadores" class="tab-pane">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br>
					<p>Elija a los empleados perteneceran a la Gerencia evaluadora <b><?php echo e($evaluador->abreviatura); ?></b>.</p><br>
				</div>

				<?php /* Capa de Seleccion Empleado */ ?>
				<div class="col-sm-7">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Empleado</p>
						</div>
						<div class="panel-body">
							<?php echo $__env->make('evaluadores/evaluador/partials/empleados/tabla_empleados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
					</div>
				</div>

				<?php /* Capa de empleados Agregados */ ?>
				<div class="col-sm-5">
						<p class="titulo-panel">Evaluadores </p><br>
					<?php echo $__env->make('evaluadores/evaluador/partials/empleados/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
			<?php /* Fin Evaluadores */ ?>

			<?php /* Cargos */ ?>
			<div id="cargos" class="tab-pane">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br>
					<p>Elija los cargos se evaluaran por Gerencia  <b><?php echo e($evaluador->abreviatura); ?></b>.</p><br>
				</div>
				<?php /* Capa de Seleccion cargos */ ?>
				<div class="row col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Cargo</p>
						</div>
						<div class="panel-body">
							<?php echo $__env->make('evaluadores/evaluador/partials/cargos/tabla_cargos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
					</div>
				</div>

				<div class="col-sm-6">
		      		<p class="titulo-panel">Cargos Agregados </p><br>
					<?php echo $__env->make('evaluadores/evaluador/partials/cargos/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
			<?php /* Fin cargos */ ?>.
		
		</div>
		<!-- Fin Panel Tab -->

	</div>
	<div class="panel-footer">
	</div>
		
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>