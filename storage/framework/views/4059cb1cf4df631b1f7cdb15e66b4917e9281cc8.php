<?php $__env->startSection('titulo'); ?>
   Tarea Programada
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Nuevo -->

<div class="panel panel-default">
  <div class="panel-heading">
      <strong><?php echo e($tarea->id); ?> - <?php echo e($tarea->descripcion); ?></strong>
  </div>
  <div class="panel-body">

  <div class="col-lg-12 breadcrumb">
    <a  href="<?php echo e(route('tareas.tareaProgramadas.index')); ?>" class="btn btn-primary btn-sm"><span class="fa fa-reply"></span></a>
  </div>

<div class="col-sm-12">
  
    <div class="col-sm-6">
          <?php echo Form::model($tarea, ['route'=>['tareas.tareaProgramadas.storeResolver', $tarea->id], 'method'=>'PUT']); ?>


            <?php echo $__env->make('partials/alert/error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  
              <div class="row col-sm-12">
                <div class="col-sm-12"> 
                  <label>Fechas de Ejecucion *</label><br>
                  <small><p>Se toma en cuenta las fecha estimadas de progamadas.</p></small>
                </div>
                
                <?php /* Fecha de Inicio */ ?>
                <div class="form-group <?php if($errors->has('fechaInicioSolucion')): ?> has-error <?php endif; ?>  col-sm-4">
                  <p>De *: </p>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="fechaInicioSolucion"  class="form-control InicioEjecucion" min="2017-2-7"  placeholder="dd/mm/aaaa" name="fechaInicioSolucion" value="<?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaInicioSolucion)); ?> " required>

                  </div>
                    <?php if($errors->has('fechaInicioSolucion')): ?> <p class="help-block"><?php echo e($errors->first('fechaInicioSolucion')); ?></p> <?php endif; ?>
                 </div>
                  
                <?php /* Fecha Fin */ ?>
                 <div class="form-group <?php if($errors->has('fechaFinSolucion')): ?> has-error <?php endif; ?>  col-sm-4">
                  <p>Hasta *:</p>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="fechaFinSolucion"  class="form-control FinEjecucion" name="fechaFinSolucion" placeholder="dd/mm/aaaa" value="<?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaFinSolucion)); ?>"  required>

                  </div>
                    <?php if($errors->has('fechaFinSolucion')): ?> <p class="help-block"><?php echo e($errors->first('fechaFinSolucion')); ?></p> <?php endif; ?>
                 </div>
            

           
                </div>

              <?php /* Tiempo estimado */ ?>
              <div class="row col-sm-12">
                <label class="form-group col-sm-12 col-xs-12">Tiempo Ejecucion *</label>
                  <div class="form-group  col-xs-6 col-sm-3 col-md-2 <?php if($errors->has('hora')): ?> has-error <?php endif; ?>">
                    <p>Horas:<p><input type="number" name="hora" max="999"  value="<?php echo e($tarea->sacarHoras($tarea->tiempoSolucion)); ?>"  class="form-control" value="00"  required >
                    <?php if($errors->has('hora')): ?> <p class="help-block"><?php echo e($errors->first('hora')); ?></p> <?php endif; ?>

                  </div> 
                  <div class="col-xs-6 col-sm-4 col-md-2 <?php if($errors->has('minuto')): ?> has-error <?php endif; ?>">
                    <p>Minutos:</p>
                     <input type="number" name="minuto" value="<?php echo e($tarea->sacarMinutos($tarea->tiempoSolucion)); ?>"  max="999" class="form-control" value="00"   required>
                    <?php if($errors->has('minuto')): ?> <p class="help-block"><?php echo e($errors->first('minuto')); ?></p> <?php endif; ?>
                  </div>
              </div>

              <?php /* estado */ ?>
              <div class="row col-sm-12">
                  <div class="form-group  col-sm-4">
                      <label >Estado </label>
                      <?php echo Form::select('estado', ['1' => 'Programado', '2' => 'En Progreso', '3' => 'Finalizado'], $tarea->estado, ['class' => 'form-control' ]); ?>

                  </div>
              </div> 

              <?php /* Observaciones */ ?>
              <div class="row col-sm-12">
                <div class="form-group <?php if($errors->has('observaciones')): ?> has-error <?php endif; ?>  col-sm-10">
                    <label for="observaciones">Observaciones</label>
                    <textarea type="textArea" name="observaciones" value="<?php echo e($tarea->observaciones); ?>"   maxlength="120" placeholder="Observaciones" class="form-control" rows="5" cols="9"></textarea>
                    <?php if($errors->has('observaciones')): ?> <p class="help-block"><?php echo e($errors->first('observaciones')); ?></p> <?php endif; ?>
                </div>
              </div>


        </div>

          <div class="col-sm-6">
  
              <b>Localizacion</b><hr class="col-sm-12">
              <div class="col-sm-12"></div>
              <p><small>Seleccione las localizaciones donde se realizaró la tarea.</small></p>
                <div class="col-sm-6">
                  <?php foreach($ubicacionesDis as $item): ?>
                      <?php /* <input type="checkbox" name="localizacion" value="<?php echo e($item->id); ?>">    <?php echo e($item->nombre); ?><br> */ ?>
                      <label><?php echo e(Form::checkbox('prov[]', $item->id)); ?> <?php echo e($item->nombre); ?></label><br>
                  <?php endforeach; ?>
                </div>
          </div>


  </div>
                  


            </div>
            <div class="modal-footer modal-delete-footer">
              <a  id="cancelar" href="<?php echo e(route('tareas.tareaProgramadas.show', $tarea->id)); ?>"  class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
              <?php echo form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

            </div>
            <?php echo Form::close(); ?>

      </div>
<!-- Fin Nuevo -->
<script>
   // function recorrerLocalizaciones(){
    $("input[type=checkbox]").each(function (index) { 
          var id = $(this).val();
        <?php foreach($ubicacionesOcu as $ubicacion): ?>
          if(id == <?php echo e($ubicacion->id); ?>){
            $(this).prop('checked', true); 
          }
        <?php endforeach; ?>
          });
    // }
$(document).ready(function(){


  $(".InicioEjecucion").datepicker({
    format: 'dd/mm/yyyy',
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 1,
    minDate: '<?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaInicioEstimado)); ?>',
    onSelect: function(selectedDate) {
      $(".FinEjecucion").datepicker("option", "minDate", selectedDate);
    }
  });

  
  $(".FinEjecucion").datepicker({
    format: 'dd/mm/yyyy',
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 1,
    maxDate: '<?php echo e($tarea->cambiarFormatoEuropeo($tarea->fechaFinEstimado)); ?>',

    onSelect: function(selectedDate) {
      $(".InicioEjecucion").datepicker( "option", "maxDate", selectedDate);
    }
  });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>