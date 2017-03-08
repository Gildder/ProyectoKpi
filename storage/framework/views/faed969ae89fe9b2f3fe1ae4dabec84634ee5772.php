<?php $__env->startSection('titulo'); ?>
  Tareas Archivadas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
<div class="panel panel-default">
  <div class="panel-heading">
    <p class="titulo-panel">Tareas Archivadas</p>
  </div>

  <div class="panel-body">


     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 breadcrumb">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <a  href="<?php echo e(route('tareas.tareaProgramadas.index')); ?>" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
        
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <?php echo $__env->make('tareas/tareaProgramadas/partials/tabla_tareaArchivados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
    
    </div>

  </div>
  <div class="panel-footer">
  </div>
</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>