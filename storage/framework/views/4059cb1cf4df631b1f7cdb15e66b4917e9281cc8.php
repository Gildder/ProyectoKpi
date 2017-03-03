<?php $__env->startSection('titulo'); ?>
  Editar Proyecto
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


      <?php echo Form::model($tarea, ['route'=>['tareas.tareaProgramadas.storeResolver', $tarea->id], 'method'=>'PUT']); ?>


              <div class="row col-sm-12">
                <div class="col-sm-12"> <label>Fechas de Solucion *</label></div>

                <?php /* Fecha de Inicio */ ?>
                <div class="form-group <?php if($errors->has('fechaInicioSolucion')): ?> has-error <?php endif; ?>  col-sm-3">
                  De *: 
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="fechaInicioSolucion"  class="form-control fechaInicio" min="2017-2-7"  placeholder="dd/mm/aaaa" name="fechaInicioSolucion" value="<?php echo e($tarea->fechaInicioSolucion); ?>" required>

                  </div>
                    <?php if($errors->has('fechaInicioSolucion')): ?> <p class="help-block"><?php echo e($errors->first('fechaInicioSolucion')); ?></p> <?php endif; ?>
                 </div>
                  
                <?php /* Fecha Fin */ ?>
                 <div class="form-group <?php if($errors->has('fechaFinSolucion')): ?> has-error <?php endif; ?>  col-sm-3">
                  Hasta *:
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="fechaFinSolucion"  class="form-control fechaFin" name="fechaFinSolucion" placeholder="dd/mm/aaaa" value="<?php echo e($tarea->fechaFinSolucion); ?>"  requvalue="<?php echo e($tarea->fechaInicioSolucion); ?>" red>

                  </div>
                    <?php if($errors->has('fechaFinSolucion')): ?> <p class="help-block"><?php echo e($errors->first('fechaFinSolucion')); ?></p> <?php endif; ?>
                 </div>
            

                <?php /* Dias Trabajados */ ?>
               <?php /*     <div class="form-group <?php if($errors->has('tiempoEstimado')): ?> has-error <?php endif; ?>  col-sm-5">
                      <label>Dias trabajados </label><br>
                          El total de días trabajados es: <label for="diasTrabajado">100</label>
                    <?php if($errors->has('tiempoEstimado')): ?> <p class="help-block"><?php echo e($errors->first('tiempoEstimado')); ?></p> <?php endif; ?>
                  </div> */ ?>
                </div>

              <?php /* Tiempo estimado */ ?>
              <div class="row col-sm-12">
                 <div class="form-group <?php if($errors->has('tiempoSolucion')): ?> has-error <?php endif; ?>  col-sm-3">
                    <label>Tiempo Solucion *</label>
                    <div class="input-group">
                        <input type="time" name="tiempoSolucion"  value="<?php echo e($tarea->tiempoSolucion); ?>" class="form-control"  placeholder="Hora:Minutos" required>
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                  <?php if($errors->has('tiempoSolucion')): ?> <p class="help-block"><?php echo e($errors->first('tiempoSolucion')); ?></p> <?php endif; ?>
                </div>

                  <div class="form-group  col-sm-3">
                      <label for="estado">Estado </label>
                      <?php echo Form::select('estado', ['1' => 'Abierto', '2' => 'En Progreso', '3' => 'Finalizado'], $tarea->estado, ['class' => 'form-control' ]); ?>

                  </div>
              </div> 

              <?php /* Observaciones */ ?>
              <div class="row col-sm-12">
                <div class="form-group <?php if($errors->has('observaciones')): ?> has-error <?php endif; ?>  col-sm-6">
                    <label for="observaciones">Observaciones</label>
                    <textarea type="textArea" name="observaciones" value="<?php echo e($tarea->observaciones); ?>"   maxlength="120" placeholder="Observaciones" class="form-control" rows="5" cols="9"></textarea>
                    <?php if($errors->has('observaciones')): ?> <p class="help-block"><?php echo e($errors->first('observaciones')); ?></p> <?php endif; ?>
                </div>
              </div>

            <?php /* Ubicacion */ ?>
         <?php /*     <div class="form-group col-sm-5 ">
                <label for="localizacion_id">Ubicaciones *</label>
                    <div class="form-group">
                      <div class="radio">
                        <?php foreach($localizaciones as $item): ?>
                          <?php echo e(Form::checkbox('localizacion_id[]', $item->id, false)); ?> <?php echo e($item->nombre); ?> <br>
                        <?php endforeach; ?>
                      </div>
                    </div>
              </div> */ ?>
             

              <div class="col-lg-12 breadcrumb">
              <b>Ubicaciones</b>
            </div>

              <div class="row col-sm-12">
                <div class="col-sm-4">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <p class="titulo-panel">Seleccionar Ubicacion</p>
                    </div>
                    <div class="panel-body">
                      <?php echo $__env->make('tareas/tareaProgramadas/partials/tabla_localizaciones', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                  </div>
                </div>

                <div class="col-sm-3">
                      <p class="titulo-panel">Ubicaciones Agregadas</p><br>
                  <?php echo $__env->make('tareas/tareaProgramadas/partials/tabla_agregados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>