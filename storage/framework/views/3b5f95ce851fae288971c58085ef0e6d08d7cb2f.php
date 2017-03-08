<?php $__env->startSection('titulo'); ?>
  Nuevo Evaluador
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">Nueva Gerencia Evaluadora</p>
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="<?php echo e(route('empleados.evaluador.index')); ?>" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
  </div>

      <?php echo Form::open(['route'=>'empleados.evaluador.store', 'method'=>'POST']); ?>


        <div class="form-group <?php if($errors->has('abreviatura')): ?> has-error <?php endif; ?>  col-sm-3">
            <label for="abreviatura" class="hidden-xs">Abreviatura</label>
            <?php echo form::text('abreviatura',null, ['id'=>'abreviatura', 'class'=>'form-control', 'placeholder'=>'Ingresa la abreviatura']); ?>

            <?php if($errors->has('abreviatura')): ?> <p class="help-block"><?php echo e($errors->first('abreviatura')); ?></p> <?php endif; ?>
        </div>

        <div class="form-group <?php if($errors->has('descripcion')): ?> has-error <?php endif; ?>  col-sm-6">
            <label for="descripcion" class="hidden-xs">Descripcion</label>
            <?php echo form::text('descripcion',null, ['id'=>'descripcion', 'class'=>'form-control', 'placeholder'=>'Ingresa la descripcion']); ?>

            <?php if($errors->has('descripcion')): ?> <p class="help-block"><?php echo e($errors->first('descripcion')); ?></p> <?php endif; ?>
        </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="<?php echo e(route('empleados.evaluador.index')); ?>" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      <?php echo form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

  </div>
      <?php echo Form::close(); ?>

</div>
<!-- Fin Nuevo -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>