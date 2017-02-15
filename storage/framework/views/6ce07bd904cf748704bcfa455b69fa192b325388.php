<?php $__env->startSection('titulo'); ?>
  <?php echo e($tarea->id); ?> - <?php echo e($tarea->descripcion); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
      <strong><?php echo e($tarea->id); ?> - <?php echo e($tarea->descripcion); ?></strong>
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="<?php echo e(route('tareas.tareaProgramadas.show', $tarea->id)); ?>" class="btn btn-primary btn-xs"><span class="fa fa-reply"></span></a>
  </div>


      <div class="col-sm-12"><p>Los campos con (*) son obligatorios</p><br></div>
      
      <?php echo Form::model($tarea, ['route'=>['tareas.tareaProgramadas.update', $tarea->id], 'method'=>'PUT']); ?>

        <?php echo Form::hidden('id', $tarea->id); ?>





<?php /* Descripcion */ ?>
<div class="col-sm-12">
  <div class="form-group <?php if($errors->has('descripcion')): ?> has-error <?php endif; ?>  col-sm-4">
    <label class="form-group">Descripcion *</label>
    <input  type="text" minlength="5" maxlength="60" name="descripcion" placeholder="Descripcion" class="form-control" value="<?php echo e($tarea->descripcion); ?>" required>
    <?php if($errors->has('descripcion')): ?> <p class="help-block"><?php echo e($errors->first('descripcion')); ?></p> <?php endif; ?>
  </div>
</div>

<?php /* Tiempo estimado */ ?>
  <div class="col-sm-12">
    <label class="form-group col-sm-12 col-xs-12">Tiempo Estimado *</label>
      <div class="form-group  col-xs-6 col-sm-3 col-md-2 <?php if($errors->has('hora')): ?> has-error <?php endif; ?>">
        <p>Horas:<p><input type="number" name="hora" max="999"  value="<?php echo e($tarea->sacarHoras($tarea->tiempoEstimado)); ?>"  class="form-control" value="00"  required >
        <?php if($errors->has('hora')): ?> <p class="help-block"><?php echo e($errors->first('hora')); ?></p> <?php endif; ?>

      </div> 
      <div class="col-xs-6 col-sm-4 col-md-2 <?php if($errors->has('minuto')): ?> has-error <?php endif; ?>">
        <p>Minutos:</p>
         <input type="number" name="minuto" value="<?php echo e($tarea->sacarMinutos($tarea->tiempoEstimado)); ?>"  max="999" class="form-control" value="00"   required>
        <?php if($errors->has('minuto')): ?> <p class="help-block"><?php echo e($errors->first('minuto')); ?></p> <?php endif; ?>
      </div>
  </div>

<div class="form-group col-sm-12">
<hr>
  <label class="form-group col-xs-12 col-sm-12">Fechas Programada *</label>

  <?php /* Fecha de Estimada */ ?>
<div class="form-group col-sm-12">
  <div class="row form-group  col-sm-12">
    <div class="row col-xs-12 col-sm-4 col-md-2 <?php if($errors->has('fechaInicioEstimado')): ?> has-error <?php endif; ?>">
      <p >De *: </p>
      <input type="text"  id="fechaInicio" value="<?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)); ?>" class="form-control fechaInicio" name="fechaInicioEstimado" required>
        <?php if($errors->has('fechaInicioEstimado')): ?> <p class="help-block"><?php echo e($errors->first('fechaInicioEstimado')); ?></p> <?php endif; ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-2  <?php if($errors->has('fechaFinEstimado')): ?> has-error <?php endif; ?>">
      <p >Hasta *: </p>
      <input type="text" id="fechaFin" value="<?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)); ?>" class="form-control fechaFin" name="fechaFinEstimado" required>
        <?php if($errors->has('fechaFinEstimado')): ?> <p class="help-block"><?php echo e($errors->first('fechaFinEstimado')); ?></p> <?php endif; ?>
    </div>
  </div>
</div>

      
  </div>
  </div>
  <div class="panel-footer text-right">
      <a  id="cancelar" href="<?php echo e(route('tareas.tareaProgramadas.show', $tarea->id)); ?>" class="btn btn-danger" type="reset"><span class="fa fa-times"></span> Cancelar</a>
      <?php echo form::button('<i class="fa fa-save"></i> Guardar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

  </div>
      <?php echo Form::close(); ?>

</div>

<!-- Fin Nuevo -->

<script>
  $(document).ready(function(){
      cargarFechas();

      $('#selecion_semana').change(function() {
          cargarFechas();
      });

      function cargarFechas()
      {
        var result = $('#selecion_semana option:selected').attr('value');
          <?php foreach($semanas as $item): ?> 
            if(<?php echo e($item['semana']); ?> == result)
            {
              $('#fechaInicio').val('<?php echo e($item['fechaInicio']); ?>');
              $('#fechaFin').val('<?php echo e($item['fechaFin']); ?>');
            }
          <?php endforeach; ?>
      }
  });
</script>


<?php $__env->stopSection(); ?>







<?php
  function nombreMes($nro)
  {
    $mes = 'mes';
    switch($nro)
    {

      case '1':
        $mes = 'Enero';
        break;
      case '2':
        $mes = 'Febrero';
        break;
      case '3':
        $mes = 'Marzo';
        break;
      case '4':
        $mes = 'Abril';
        break;
      case '5':
        $mes = 'Mayo';
        break;
      case '6':
        $mes = 'Junio';
        break;
      case '7':
        $mes = 'Julio';
        break;
      case '8':
        $mes = 'Agosto';
        break;
      case '9':
        $mes = 'Septiembre';
        break;
      case '10':
        $mes = 'Octubre';
        break;
      case '11':
        $mes = 'Noviembre';
        break;
      case '12':
        $mes = 'Diciembre';
        break;

    }
    return $mes;
  }
?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>