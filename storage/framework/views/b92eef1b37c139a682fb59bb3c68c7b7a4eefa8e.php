<?php $__env->startSection('titulo'); ?>
  Nueva Tarea
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="panel panel-default">
  <div class="panel-heading">
    <a  href="<?php echo e(route('tareas.tareaProgramadas.index')); ?>" class="btn btn-primary btn-xs pull-left btn-back" title="Volver"><span class="fa fa-reply"></span></a>
    <p class="titulo-panel">Nueva Tarea</p>

  </div>
  <div class="panel-body">

  <div class="col-sm-12"><p>Los campos con (*) son obligatorios</p></div>

      <?php echo Form::open(['route'=>'tareas.tareaProgramadas.store', 'method'=>'POST']); ?>


<?php /* Descripcion */ ?>
<div class="col-sm-12">
  <div class="form-group <?php if($errors->has('descripcion')): ?> has-error <?php endif; ?>  col-sm-4">
    <label class="form-group">Descripcion *</label>
    <input  type="text" minlength="5" maxlength="60" name="descripcion" placeholder="Descripcion" class="form-control" required>
    <?php if($errors->has('descripcion')): ?> <p class="help-block"><?php echo e($errors->first('descripcion')); ?></p> <?php endif; ?>
  </div>
</div>

<?php /* Tiempo estimado */ ?>
  <div class="col-sm-12">
    <label class="form-group col-sm-12 col-xs-12">Tiempo Estimado *</label>
      <div class="form-group  col-xs-6 col-sm-3 col-md-2 <?php if($errors->has('hora')): ?> has-error <?php endif; ?>">
        Horas:<input type="number" min="0"  name="hora" max="999"  class="form-control" value="00"  required >

      </div> 
        <?php if($errors->has('hora')): ?> <p class="help-block"><?php echo e($errors->first('hora')); ?></p> <?php endif; ?>
      <div class="col-xs-6 col-sm-4 col-md-2 <?php if($errors->has('minuto')): ?> has-error <?php endif; ?>">
        Minutos: <input type="number" min="0" name="minuto" max="999" class="form-control" value="00"   required>
      </div>
        <?php if($errors->has('minuto')): ?> <p class="help-block"><?php echo e($errors->first('minuto')); ?></p> <?php endif; ?>
  </div>

<div class="form-group col-sm-12">
  <div class="row form-group  col-sm-12">
    <div class="col-xs-12 col-sm-4 col-md-2 <?php if($errors->has('fechaInicioEstimado')): ?> has-error <?php endif; ?>">
      <b>Fecha Inicio *: </b>
      <input type="text"  id="fechaInicio" class="form-control fechaInicio" name="fechaInicioEstimado" required>
        <?php if($errors->has('fechaInicioEstimado')): ?> <p class="help-block"><?php echo e($errors->first('fechaInicioEstimado')); ?></p> <?php endif; ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2  <?php if($errors->has('fechaFinEstimado')): ?> has-error <?php endif; ?>">
      <b>Fecha Fin *: </b>
      <input type="text" id="fechaFin" class="form-control fechaFin" name="fechaFinEstimado" required>
        <?php if($errors->has('fechaFinEstimado')): ?> <p class="help-block"><?php echo e($errors->first('fechaFinEstimado')); ?></p> <?php endif; ?>
    </div>
  </div>
</div>
        <?php /* Fin body  model */ ?>
        </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="<?php echo e(route('tareas.tareaProgramadas.index')); ?>" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      <?php echo form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit']); ?>

  </div>
      <?php echo Form::close(); ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>