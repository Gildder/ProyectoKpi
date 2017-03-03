<?php $__env->startSection('titulo'); ?>
	<?php echo e($tarea->id); ?> - <?php echo e($tarea->descripcion); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel"><?php echo e($tarea->id); ?> - <?php echo e($tarea->descripcion); ?></p>
	</div>

	<div class="panel-body">

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
		</ul>

		<div class="tab-content">
			<div id="datos" class="tab-pane fade in active">
				<div class="col-lg-12 breadcrumb">
					<a href="<?php echo e(route('tareas.tareaProgramadas.index')); ?>" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
				</div>
					<div class="content col-sm-6">

      					<?php /* <?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> */ ?>

						<?php echo $__env->make('tareas/tareaProgramadas/partials/datos_tarea', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	

						<?php echo $__env->make("tareas/tareaProgramadas/delete", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

						<?php /* <?php echo $__env->make("tareas/tareaProgramadas/partials/datos_solucion", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> */ ?>
					</div>
					<div class="col-sm-12 panel-footer text-right">
		
						<?php /* <a href="<?php echo e(route('tareas.tareaProgramadas.edit', $tarea->id)); ?>" class="btn btn-primary btn-sm"><span class="fa fa-ok text-left"></span><b> Solucion</b> </a> */ ?>
						<a href="<?php echo e(route('tareas.tareaProgramadas.resolver', $tarea->id)); ?>" class="btn btn-primary btn-sm"><span class="fa fa-ok text-left"></span><b> Resolver</b> </a>
						<a href="<?php echo e(route('tareas.tareaProgramadas.edit', $tarea->id)); ?>" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
						<a href="#"  data-toggle="modal" data-target="#modal-delete-<?php echo e($tarea->id); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>

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