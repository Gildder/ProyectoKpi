
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-deleteCargoEvaluador-{{$item->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Quitar Cargo</b>
      </div>
      <div class="modal-body modal-delete-body">
           {!!Form::open(['action'=>['Evaluadores\EvaluadorController@quitarcargo', $item->id, $evaluador->id], 'method'=>'GET'])!!}
            <div class="modal-body">
              <p>¿Estas seguro que deseas quitar a <b>{{$item->nombre}}</b>?</p>
            </div>
            <div class="modal-footer modal-delete-footer">
                <a href="javascript:void(0)"  data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
                <button type="submit" @click="mostrarModalLoading()"  class="btn btn-success guardar" type="reset"><span class="fa fa-check"></span> Aceptar</button>

            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>
