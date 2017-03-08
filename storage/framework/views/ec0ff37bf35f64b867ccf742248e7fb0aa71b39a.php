<?php $__env->startSection('titulo'); ?>
	Empleado
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
	<div class="panel-heading">
	  <p class="titulo-panel"><?php echo e($empleados->codigo); ?> - <?php echo e($empleados->nombres); ?> <?php echo e($empleados->apellidos); ?></p>
	</div>

	<div class="panel-body">
		

		<!--panelTab -->
		<ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
		</ul>

		<div class="tab-content">
			<div id="datos" class="tab-pane fade in active">
				<div class="col-lg-12 breadcrumb">
					<a href="<?php echo e(route('empleados.empleado.index')); ?>" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
				</div>
				<div class="col-sm-6">
					<div class="content">
						<?php echo $__env->make('empleados/empleado/ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	

						<?php echo $__env->make("empleados/empleado/delete", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					</div>
				</div>
				<div class="col-sm-12 panel-footer text-right">
		
					<a href="<?php echo e(route('empleados.empleado.edit', $empleados->codigo)); ?>" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
					<a href="#"  data-toggle="modal" data-target="#modal-delete-<?php echo e($empleados->codigo); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span><b> Borrar</b> </a>

				</div>
			</div>


		
		<!-- Fin Panel Tab -->

		</div>

	</div>
		
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>