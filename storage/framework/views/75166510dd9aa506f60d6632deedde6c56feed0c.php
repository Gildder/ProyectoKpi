<?php $__env->startSection('titulo'); ?>
  <?php echo e($indicador->nombre); ?> - <?php echo e($cargo->nombre); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel"><?php echo e($indicador->id); ?> - <?php echo e($indicador->nombre); ?></p>


  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="<?php echo e(route('indicadores.indicadorcargos.show', $indicador->id)); ?>" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
  </div>
      <div class="col-sm-12">
        <p class="titulo-panel"><?php echo e($cargo->nombre); ?></p><p></p>
        <p>Por favor seleccione las caracteristica del indicador <?php echo e($indicador->nombre); ?> para el cargo o puesto elegido.</p><br>
      </div>  

      <?php echo Form::model($indicadorcargo, ['route'=>['indicadores.indicadorcargos.update',  $cargo->id, $indicador->id], 'method'=>'PUT']); ?>


<div class="row col-sm-12">
  
        <div class="form-group <?php if($errors->has('condicion')): ?> has-error <?php endif; ?>  col-sm-6">
            <label for="condicion" class="hidden-xs">Condicion</label>
            <?php echo form::text('condicion',null, ['id'=>'condicion', 'class'=>'form-control', 'placeholder'=>'La condicion que se aplicara']); ?>

            <?php if($errors->has('condicion')): ?> <p class="help-block"><?php echo e($errors->first('condicion')); ?></p> <?php endif; ?>
        </div>
</div>

<div class="row col-sm-12">
        <div class="form-group <?php if($errors->has('aclaraciones')): ?> has-error <?php endif; ?>  col-sm-6">
            <label for="aclaraciones" class="hidden-xs">Aclaraciones</label>
            <?php echo form::text('aclaraciones',null, ['id'=>'aclaraciones', 'class'=>'form-control', 'placeholder'=>'Coloca algunas aclaraciones']); ?>

            <?php if($errors->has('aclaraciones')): ?> <p class="help-block"><?php echo e($errors->first('aclaraciones')); ?></p> <?php endif; ?>
        </div>
</div>        

<div class="row col-sm-12">
  <div class="col-sm-12">
    
            <label for="objetivo" class="hidden-xs">Objetivo (*)</label>
            <p><?php echo e($indicador->descripcion_objetivo); ?> a un:</p>
  </div>
        <div class="form-group <?php if($errors->has('objetivo')): ?> has-error <?php endif; ?>  col-sm-4">
            <?php echo form::text('objetivo',null, ['id'=>'objetivo', 'class'=>'form-control col-sm-2', 'placeholder'=>'El valor del objetivo en %']); ?>

            <?php if($errors->has('objetivo')): ?> <p class="help-block"><?php echo e($errors->first('objetivo')); ?></p> <?php endif; ?>
        </div>
</div>
      
      <div class="form-group <?php if($errors->has('frecuencia_id')): ?> has-error <?php endif; ?>  col-sm-4">
          <label for="frecuencia_id" class="hidden-xs">Frecuencia (*)</label>
              <!--
              <?php echo form::select('nombregrupo',$frecuencia, null, ['id'=>'frecuencia_id', 'class'=>'form-control', 'placeholder'=>'Seleccionar..']); ?>

              -->
              <select class="form-control" name="frecuencia_id">
                  <?php foreach($frecuencia as $item): ?>
                     <?php if($item->id == $indicadorcargo->frecuencia_id): ?>
                           <option value="<?php echo e($item->id); ?>" selected="selected" ><?php echo e($item->nombre); ?></option>
                     <?php else: ?>
                           <option value="<?php echo e($item->id); ?>" ><?php echo e($item->nombre); ?></option>
                     <?php endif; ?>
                  <?php endforeach; ?>
              </select>
              <?php if($errors->has('frecuencia_id')): ?> <p class="help-block"><?php echo e($errors->first('frecuencia_id')); ?></p> <?php endif; ?>

        </div>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="<?php echo e(route('indicadores.indicadorcargos.show', $indicador->id)); ?>" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      <?php echo form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

  </div>
      <?php echo Form::close(); ?>

</div>

<!-- Fin Nuevo -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>