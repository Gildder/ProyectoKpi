<?php $__env->startSection('titulo'); ?>
      <?php echo e($indicador->nombre); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel"><?php echo e($indicador->nombre); ?></p>
  </div>

  <div class="panel-body">
   

    <!--panelTab -->
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#datos">Datos</a></li>
    </ul>

    <div class="tab-content">
      <?php /* Datos del Indiador */ ?>
      <div id="datos" class="tab-pane fade in active">
          <div class="col-lg-12 breadcrumb">
            <a href="<?php echo e(route('indicadores.indicador.index')); ?>" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
          </div>
        <div class="col-sm-12">

          <div class="content col-lg-6">
            <?php echo $__env->make('indicadores/indicador/partials/ver_indicador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
            <?php echo $__env->make('indicadores/indicador/delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

          </div>
        </div>
      
        <div class="col-sm-12 panel-footer text-right">
          <a href="<?php echo e(route('indicadores.indicador.edit', $indicador->id)); ?>" class="btn btn-warning btn-sm"><span class="fa fa-edit text-left"></span><b> Editar</b> </a>
          <a href="#" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-delete-<?php echo e($indicador->id); ?>"><span class="fa fa-trash"  title="Eliminar"></span><b > Borrar</b></a>
        </div>
      </div>
    <!-- Fin Indicador -->

    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>