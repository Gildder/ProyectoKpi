<?php $__env->startSection('titulo'); ?>
      Seleccionar
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel"><?php echo e($departamento->nombre); ?></p>
  </div>

  <div class="panel-body">

    <!--panelTab -->
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
    </ul>

    <div class="tab-content">
      <div id="datos" class="tab-pane fade in active">
          <div class="col-lg-12 breadcrumb">
            <a href="<?php echo e(route('supervisores.supervisor.index')); ?>" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
          </div>
        <div class="col-sm-12">

          <div class="content col-sm-12">

            <?php echo $__env->make('supervisores/supervisor/partials/seleccionar_empleado', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  

          </div>
        </div>
      
      </div>

    <!-- Fin Panel Tab -->

  </div>

  </div>
    
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>