<?php $__env->startSection('titulo'); ?>
  Nueva ponderacion
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="<?php echo e(route('evaluadores.ponderacion.index')); ?>" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">Nueva Ponderacion</p>
  </div>
  <div class="panel-body">

      <?php echo Form::open(['route'=>'evaluadores.ponderacion.store', 'method'=>'POST']); ?>

      <div class="col-md-12">
        
        <div class="form-group <?php if($errors->has('nombre')): ?> has-error <?php endif; ?>  col-sm-6">
            <label for="nombre" >Nombre</label>
    <input  type="text" minlength="5" maxlength="50" name="nombre" placeholder="Ingresa el Nombre" class="form-control" required>
            <?php if($errors->has('nombre')): ?> <p class="help-block"><?php echo e($errors->first('nombre')); ?></p> <?php endif; ?>
        </div>
      </div>
      
      <div class="col-md-12">
        
        <div class="form-group <?php if($errors->has('descripcion')): ?> has-error <?php endif; ?>  col-sm-6">
            <label for="descripcion" >Descripcion</label>
        <textarea type="textArea" name="descripcion"  maxlength="120" placeholder="Ingresa la Descripcion" class="form-control" rows="5" cols="9" required></textarea>

            <?php if($errors->has('descripcion')): ?> <p class="help-block"><?php echo e($errors->first('descripcion')); ?></p> <?php endif; ?>
        </div>
      </div>
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="<?php echo e(route('evaluadores.ponderacion.index')); ?>" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      <?php echo form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

  </div>
      <?php echo Form::close(); ?>

</div>
<!-- Fin Nuevo -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>