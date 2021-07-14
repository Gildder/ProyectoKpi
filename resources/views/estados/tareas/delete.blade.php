
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-delete-{{$estado->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>@lang('labels.panels.pnsEliminar')</b>
      </div>
      <div class="modal-body modal-delete-body" style="padding: 0px">
           {!!Form::open(['action'=>['Estados\EstadoTareaController@destroy', $estado->id], 'method'=>'DELETE'])!!}
            <div class="modal-body">
              <p>¿Estas seguro que deseas eliminar el Estado <b>{{$estado->nombre}}?</b></p>
            </div>
            <div class="modal-footer modal-delete-footer" >
              <a  data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> @lang('labels.buttons.btnCancelar')</a>
              {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>
