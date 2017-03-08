<?php $__env->startSection('titulo'); ?>
  Nuevo Indicador
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Nuevo -->
<div class="panel panel-default">
  <div class="panel-heading">
      <p class="titulo-panel">Nuevo Indicador</p>
      
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="<?php echo e(route('indicadores.indicador.index')); ?>" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
  </div>

      <?php echo Form::open(['route'=>'indicadores.indicador.store', 'method'=>'POST']); ?>


        <div class="form-group <?php if($errors->has('nombre')): ?> has-error <?php endif; ?>  col-sm-6">
            <label for="nombre" class="hidden-xs">Nombre</label>
            <?php echo form::text('nombre',null, ['id'=>'nombre', 'class'=>'form-control', 'placeholder'=>'Ingresa el Nombre']); ?>

            <?php if($errors->has('nombre')): ?> <p class="help-block"><?php echo e($errors->first('nombre')); ?></p> <?php endif; ?>
        </div>

        <div class="form-group  <?php if($errors->has('orden')): ?> has-error <?php endif; ?>  col-xs-12 col-sm-3 col-md-3">
          <label for="orden">Orden</label>
          <select class="form-control" name="orden">
              <option value="" >Seleccionar...</option>
              <?php for($i = 1; $i<= 20; $i++): ?>
                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
              <?php endfor; ?>
          </select>
          <?php if($errors->has('orden')): ?> <p class="help-block"><?php echo e($errors->first('orden')); ?></p> <?php endif; ?>
        </div>


        <div class="form-group <?php if($errors->has('descripcion_objetivo')): ?> has-error <?php endif; ?>  col-sm-9">
            <label for="descripcion_objetivo" class="hidden-xs">Objetivo del Indicador</label>
            <?php echo form::text('descripcion_objetivo',null, ['id'=>'descripcion_objetivo', 'class'=>'form-control', 'placeholder'=>'Describe el descripcion_objetivo']); ?>

            <?php if($errors->has('descripcion_objetivo')): ?> <p class="help-block"><?php echo e($errors->first('descripcion_objetivo')); ?></p> <?php endif; ?>
        </div>

        <div class="form-group <?php if($errors->has('tipo_indicador_id')): ?> has-error <?php endif; ?>  col-sm-5 ">
          <label for="tipo_indicador_id" class="hidden-xs">Tipo Indicador</label>
              <!--
              <?php echo form::select('tipo',$tipo, null, ['id'=>'tipo', 'class'=>'form-control', 'placeholder'=>'Seleccionar..']); ?>

              -->
              <select class="form-control" name="tipo_indicador_id">
                    <option value="" >Seleccionar...</option>
                  <?php foreach($tipo as $item): ?>
                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->nombre); ?></option>
                  <?php endforeach; ?>
              </select>
              <?php if($errors->has('tipo_indicador_id')): ?> <p class="help-block"><?php echo e($errors->first('tipo_indicador_id')); ?></p> <?php endif; ?>

        </div>

        <?php /* <?php echo $__env->make('indicadores/indicador/partials/seleccionar_variables', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> */ ?>
      
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="<?php echo e(route('indicadores.indicador.index')); ?>" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      <?php echo form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

  </div>
      <?php echo Form::close(); ?>

</div>
<!-- Fin Nuevo -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>