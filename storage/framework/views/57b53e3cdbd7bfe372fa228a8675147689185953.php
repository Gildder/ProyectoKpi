<?php $__env->startSection('titulo'); ?>
      Nuevo Departamento
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<div class="panel panel-default">
  <div class="panel-heading">
     <a  href="<?php echo e(route('localizaciones.departamento.index')); ?>" class="btn btn-primary btn-xs btn-back pull-left"><span class="fa fa-reply"></span></a>
      <p class="titulo-panel">Nuevo Departamento</p>
  </div>
  <div class="panel-body">

      <?php echo Form::open(['route'=>'localizaciones.departamento.store', 'method'=>'POST']); ?>

        <div class="form-group <?php if($errors->has('nombre')): ?> has-error <?php endif; ?> col-sm-5 ">
              <label for="nombre" >Nombre</label>
              <?php echo form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingresa el Nombre']); ?>

              <?php if($errors->has('nombre')): ?> <p class="help-block"><?php echo e($errors->first('nombre')); ?></p> <?php endif; ?>
        </div>
        <div class="form-group <?php if($errors->has('grupodep_id')): ?> has-error <?php endif; ?>  col-sm-5 ">
          <label for="grupodep_id" >Grupo Departamento</label>
              
              <select class="form-control" name="grupodep_id">
                    <option value="" >Seleccionar...</option>
                  <?php foreach($grupo as $item): ?>
                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->nombre); ?></option>
                  <?php endforeach; ?>
              </select>
              <?php if($errors->has('grupodep_id')): ?> <p class="help-block"><?php echo e($errors->first('grupodep_id')); ?></p> <?php endif; ?>

        </div>
  </div>
  <div class="panel-footer text-right">
    <a  id="cancelar" href="<?php echo e(route('localizaciones.departamento.index')); ?>" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
    <?php echo form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

  </div>
      <?php echo Form::close(); ?>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>