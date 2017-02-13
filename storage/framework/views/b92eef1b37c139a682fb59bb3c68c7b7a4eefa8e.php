
<!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-nuevo">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
    <?php /* Header de modal */ ?>
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Nueva Tarea Programada</b>
      </div>

      <?php /* Body del modal */ ?>
      <div class="modal-body modal-delete-body">
        <?php echo Form::open(['route'=>'tareas.tareaProgramadas.store', 'method'=>'POST']); ?>


        <?php /* Modal body */ ?>
        <div class="modal-body col-sm-12">

<?php /* Descripcion */ ?>
<div class="col-sm-12">
  <div class="form-group <?php if($errors->has('descripcion')): ?> has-error <?php endif; ?>  col-sm-10">
    <label class="row">Descripcion *</label>
    <input type="text" minlength="5" maxlength="60" name="descripcion" placeholder="Descripcion" class="form-control" required>
    <?php if($errors->has('descripcion')): ?> <p class="help-block"><?php echo e($errors->first('descripcion')); ?></p> <?php endif; ?>
  </div>
</div>

<?php /* Tiempo estimado */ ?>
<div class="col-sm-12">
 <div class="form-group <?php if($errors->has('tiempoEstimado')): ?> has-error <?php endif; ?>">
    <label>Tiempo Estimado *</label>
    <div class="row col-sm-12">
      <div class="col-xs-6 col-sm-4 col-md-5">
        Horas:<input type="text" name="hora" class="form-control" value="00"  required >
      </div> 
      <div class="col-xs-6 col-sm-4 col-md-5">
        Minutos: <input type="text" name="minutos" class="form-control" value="00"   required>
      </div>
    </div>
  <?php if($errors->has('tiempoEstimado')): ?> <p class="help-block"><?php echo e($errors->first('tiempoEstimado')); ?></p> <?php endif; ?>
</div>
</div> 


<div class="col-sm-12">
  <hr>
  <label class=" row col-sm-12">Semana Programada *</label>
  <small>Selecciona la semana que deseas programas tu tarea.</small><br><br>
  <?php /* Fecha de Inicio */ ?>
  <div class="form-group col-sm-12">
      Selecciona:
      <select name="selecion_semana" id="selecion_semana">
          <?php foreach($semanas as $item): ?>
                <option value="<?php echo e($item['semana']); ?>">Semana <?php echo e($item['semana']); ?> del Mes de <?php echo e(nombreMes($item['mes'])); ?></option> 
          <?php endforeach; ?>
      </select>
  </div>
  <div class="row form-group  col-sm-12">
    <div class="col-sm-4">Fecha Inicio: <label id="fechaInicio"></label></div>
    <div class="col-sm-4">Fecha Fin: <label id="fechaFin"></label></div>
  </div>
</div>
        <?php /* Fin body  model */ ?>
        </div>
        <div class="modal-footer modal-delete-footer">
          <a data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
          <?php echo form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

        </div>
        <?php echo Form::close(); ?>

      </div>
      </div>

    </div>
    <?php /* fin ontenido  */ ?>
</div>



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
              $('#fechaInicio').html('<?php echo e($item['fechaInicio']); ?>');
              $('#fechaFin').html('<?php echo e($item['fechaFin']); ?>');
            }
          <?php endforeach; ?>
      }
    
  });
</script>

