
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-delete-<?php echo e($ponderacion->id); ?>">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Eliminar Ponderacion
      </div>
      <div class="modal-body modal-delete-body">
           <?php echo Form::open(['action'=>['Evaluadores\PonderacionController@destroy', $ponderacion->id], 'method'=>'DELETE']); ?>

            <div class="modal-body">
              <p>¿Estas seguro que deseas eliminar a <b><?php echo e($ponderacion->nombre); ?>?</b></p>
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
