<?php $__env->startSection('titulo'); ?>
  Nuevo Evaluador
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="<?php echo e(route('evaluadores.evaluador.index')); ?>" class="btn btn-primary btn-xs btn-back pull-left" title="Volver"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">Nueva Gerencia Evaluadora</p>
  </div>
  <div class="panel-body">

      <?php echo Form::open(['route'=>'evaluadores.evaluador.store', 'method'=>'POST']); ?>

      <div class="col-md-12">
        <p>Los campos con (*) son obligatorios.</p>
      </div>
  
      <div class="row col-md-12">
        <div class="form-group <?php if($errors->has('descripcion')): ?> has-error <?php endif; ?>  col-sm-4">
            <label for="descripcion" >Nombre *</label>
    <input  type="text"  maxlength="40" name="descripcion" placeholder="Ingresa el nombre" class="form-control" required>
            <?php if($errors->has('descripcion')): ?> <p class="help-block"><?php echo e($errors->first('descripcion')); ?></p> <?php endif; ?>
        </div>
      </div>

      <div class="row col-md-12">
        <div class="form-group <?php if($errors->has('abreviatura')): ?> has-error <?php endif; ?>  col-sm-1">
            <label for="abreviatura" >Abreviatura *</label>
            <input  type="text"  maxlength="10" name="abreviatura" placeholder="eg: GADM" class="form-control" required>
            <?php if($errors->has('abreviatura')): ?> <p class="help-block"><?php echo e($errors->first('abreviatura')); ?></p> <?php endif; ?>
        </div>

      </div>
      <div class="row col-md-12">  
        <div class="form-group <?php if($errors->has('ponderacion_id')): ?> has-error <?php endif; ?>  col-sm-3 ">
            <label for="ponderacion_id" >Selecciona Ponderacion *</label>
            <select class="form-control" name="ponderacion_id">
                <option value="" >Seleccionar...</option>
                <?php foreach($ponderaciones as $items): ?>
                  <option value="<?php echo e($items->id); ?>"><?php echo e($items->nombre); ?></option>
                <?php endforeach; ?>
            </select>
            <?php if($errors->has('ponderacion_id')): ?> <p class="help-block"><?php echo e($errors->first('ponderacion_id')); ?></p> <?php endif; ?>
        </div>
      </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="<?php echo e(route('evaluadores.evaluador.index')); ?>" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      <?php echo form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

  </div>
      <?php echo Form::close(); ?>

</div>
<!-- Fin Nuevo -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>