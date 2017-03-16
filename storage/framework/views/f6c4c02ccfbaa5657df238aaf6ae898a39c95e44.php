   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-delete-<?php echo e($indicador->id); ?>">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Eliminar indicdador
      </div>
      <div class="modal-body modal-delete-body">
           <?php echo Form::open(['action'=>['Indicadores\IndicadorController@destroy',$indicador->id], 'method'=>'DELETE']); ?>

            <div class="modal-body">
              <p>¿Estas seguro que deseas Eliminar a <b><?php echo e($indicador->nombre); ?></b>?</p>
            </div>
            <div class="modal-footer modal-delete-footer">
              <a data-dismiss="modal" class="btn btn-danger"  type="reset"><span class="fa fa-times"></span> Cancelar</a>
              <?php echo form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'guardar', 'id'=>'guardar', 'content'=>'Guardar', 'class'=>'btn btn-success', 'type'=>'submit' ]); ?>

            </div>
            <?php echo Form::close(); ?>

      </div>
    </div>

  </div>
</div>
