<?php $__env->startSection('titulo'); ?>
	Nuevo Empleado
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel"><?php echo e($empleado->codigo); ?> - <?php echo e($empleado->nombres); ?></p>
  </div>
  <div class="panel-body">


	<div class="col-lg-12 breadcrumb">
		<a  href="<?php echo e(route('empleados.empleado.index')); ?>" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
	</div>
      
      <?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <?php echo Form::model($empleado, ['route'=>['empleados.empleado.update', $empleado->codigo], 'method'=>'PUT']); ?>


        <?php echo $__env->make('empleados/empleado/partials/actualizar_atributos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="<?php echo e(route('empleados.empleado.index')); ?>" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
    <?php echo form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

  </div>
      <?php echo Form::close(); ?>

</div>

<!-- Fin Nuevo -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>