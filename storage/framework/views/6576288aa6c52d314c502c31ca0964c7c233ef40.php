<?php $__env->startSection('titulo'); ?>
	<?php echo e($evaluador->id); ?> - <?php echo e($evaluador->abreviatura); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
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
				<div class="col-lg-12 breadcrumb">
					<a href="<?php echo e(route('empleados.evaluador.index')); ?>" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
				</div>
				<div class="content col-sm-6">

					<?php echo $__env->make('empleados/evaluador/partials/datos_evaluador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	

					<?php echo $__env->make("empleados/evaluador/delete", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				<div class="col-sm-12 panel-footer text-right">
					<a href="<?php echo e(route('empleados.evaluador.edit', $evaluador->id)); ?>" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
					<a href="#"  data-toggle="modal" data-target="#modal-delete-<?php echo e($evaluador->id); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>
				</div>
			</div>

			<?php /* Evaluadores */ ?>
			<div id="evaluadores" class="tab-pane">
				<div class="col-lg-12 breadcrumb">
					<a href="<?php echo e(route('empleados.evaluador.index')); ?>" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
				</div>
				<?php /* Capa de Seleccion Empleado */ ?>
				<div class="col-sm-7">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Empleado</p>
						</div>
						<div class="panel-body">
							<?php echo $__env->make('empleados/evaluador/partials/empleados/tabla_empleados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
					</div>
				</div>

				<?php /* Capa de empleados Agregados */ ?>
				<div class="col-sm-5">
						<p class="titulo-panel">Evaluadores </p><br>
					<?php echo $__env->make('empleados/evaluador/partials/empleados/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
			<?php /* Fin Evaluadores */ ?>

			<?php /* Evaluadores */ ?>
			<div id="cargos" class="tab-pane">
				<div class="col-lg-12 breadcrumb">
					<a href="<?php echo e(route('empleados.evaluador.index')); ?>" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
				</div>
				<?php /* Capa de Seleccion cargos */ ?>

				<div class="row col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
						  <p class="titulo-panel">Selecciona Cargo</p>
						</div>
						<div class="panel-body">
							<?php echo $__env->make('empleados/evaluador/partials/cargos/tabla_cargos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
					</div>
				</div>

				<div class="col-sm-6">
		      		<p class="titulo-panel">Cargos Agregados </p><br>
					<?php echo $__env->make('empleados/evaluador/partials/cargos/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
			<?php /* Fin cargos */ ?>
		</div>
		<!-- Fin Panel Tab -->

	</div>
	<div class="panel-footer">
	</div>
		
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>