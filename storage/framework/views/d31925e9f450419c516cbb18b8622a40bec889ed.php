<?php $__env->startSection('titulo'); ?>
      Editar Grupo Localizacion
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="<?php echo e(route('localizaciones.grupolocalizacion.index')); ?>" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel"><?php echo e($grupolocalizacion->id); ?> - <?php echo e($grupolocalizacion->nombre); ?></p>
  </div>
  <div class="panel-body">

      <?php echo Form::model($grupolocalizacion, ['route'=>['localizaciones.grupolocalizacion.update', $grupolocalizacion->id], 'method'=>'PUT']); ?>

        <?php echo Form::hidden('id', $grupolocalizacion->id); ?>

      
      <div class="form-group <?php if($errors->has('nombre')): ?> has-error <?php endif; ?>  col-sm-5">
            <label for="nombre" class="hidden-xs">Nombre</label>
            <?php echo form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingresa el Nombre']); ?>

            <?php if($errors->has('nombre')): ?> <p class="help-block"><?php echo e($errors->first('nombre')); ?></p> <?php endif; ?>
            
      </div>
                
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="<?php echo e(route('localizaciones.grupolocalizacion.index')); ?>" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      <?php echo form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

  </div>
      <?php echo Form::close(); ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>