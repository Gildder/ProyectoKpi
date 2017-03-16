
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-escala-<?php echo e($item->id); ?>">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Limites a Escala Cumplimiento
      </div>
      <div class="modal-body modal-delete-body">
           <?php echo Form::open(['action'=>['Evaluadores\PonderacionController@agregarescala',  $ponderacion->id, $item->id], 'method'=>'GET']); ?>


            <div class="modal-body">
              <p>Agregar Limites a las Escala de Cumplimiento <b><?php echo e($item->nombre); ?>?</b></p>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>Limite Minimo</label>
                <input  type="number" min="0" max="999" name="minimo" placeholder="Valor Minimo" class="form-control" required>
              </div>
            </div>
             <div class="col-md-12">
              <div class="form-group">
                <label>Limite Maximo</label>
                <input  type="number" min="0" max="999" name="maximo" placeholder="Valor Maximo" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer modal-delete-footer">
              <a  data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
              <?php echo form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

            </div>
            <?php echo Form::close(); ?>

      </div>
    </div>

  </div>
</div>
