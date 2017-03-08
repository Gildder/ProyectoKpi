<?php $__env->startSection('titulo'); ?>
   Eliminados
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">Cargos Eliminados</p>
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="<?php echo e(route('empleados.cargo.index')); ?>" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <?php echo $__env->make('empleados/cargo/partials/tabla_eliminados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
  </div>
    </div>
    <div class="panel-footer">
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>