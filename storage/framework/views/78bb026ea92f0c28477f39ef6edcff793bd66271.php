<?php $__env->startSection('titulo'); ?>
  Editar cargo
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="<?php echo e(route('empleados.cargo.index')); ?>" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
      <strong></strong>
      <p class="titulo-panel"><?php echo e($cargo->id); ?> - <?php echo e($cargo->nombre); ?></p>

  </div>
  <div class="panel-body">


      <?php echo Form::model($cargo, ['route'=>['empleados.cargo.update', $cargo->id], 'method'=>'PUT']); ?>

        <?php echo Form::hidden('id', $cargo->id); ?>

      <div class="form-group <?php if($errors->has('nombre')): ?> has-error <?php endif; ?> col-sm-3">
          <label for="nombre" class="hidden-xs">Nombre</label>
          <?php echo form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingresa el Nombre']); ?>

          <?php if($errors->has('nombre')): ?> <p class="help-block"><?php echo e($errors->first('nombre')); ?></p> <?php endif; ?>
      </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="<?php echo e(route('empleados.cargo.show', $cargo->id)); ?>" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      <?php echo form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

  </div>
      <?php echo Form::close(); ?>

</div>

<!-- Fin Nuevo -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>