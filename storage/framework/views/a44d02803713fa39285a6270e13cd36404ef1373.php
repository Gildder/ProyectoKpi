<?php $__env->startSection('content'); ?>
<div class="panel panel-default">
   <div class="panel-heading">
      <a  href="<?php echo e(route('localizaciones.localizacion.index')); ?>" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel"><?php echo e($localizacion->id); ?> - <?php echo e($localizacion->nombre); ?></p>
   </div>
   <div class="panel-body">
      <?php echo Form::model($localizacion, ['route'=>['localizaciones.localizacion.update', $localizacion->id], 'method'=>'PUT']); ?>

        <?php echo Form::hidden('id', $localizacion->id); ?>


        <?php echo $__env->make('localizaciones/localizacion/partials/actualizar_atributos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                
   </div>
   <div class="panel-footer text-right">
      <a  id="cancelar" href="<?php echo e(route('localizaciones.localizacion.index')); ?>" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
    <?php echo form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

   </div>
      <?php echo Form::close(); ?>

</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>