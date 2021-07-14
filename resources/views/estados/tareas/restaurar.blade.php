
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-restaurar-{{$estado->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="titulo-panel">@lang('labels.panels.pnsRestaurar')</p>
      </div>
      <div class="modal-body modal-delete-body" style="padding: 0px;">
           {!!Form::open(['action'=>['Estados\EstadoTareaController@restaurar', $estado->id], 'method'=>'PUT'])!!}
            <div class="modal-body">
              <p>¿Estas seguro que deseas restaurar estado <b>{{$estado->nombre}}?</b></p>
            </div>
            <div class="modal-footer modal-delete-footer">
              <a  data-dismiss="modal" class="@lang('labels.stylbtns.btnCancelar')" >
                  <span class="@lang('labels.icons.icoCancel')"></span> @lang('labels.buttons.btnCancelar')</a>
              {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>
