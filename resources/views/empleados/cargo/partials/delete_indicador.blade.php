<!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-supr-{{$indicador->id}}">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header btn-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Quitar Inidicador
      </div>
      <div class="modal-body">
           {!!Form::open(['action'=>['Empleados\CargoController@quitar', $indicador->id, $cargo->id ], 'method'=>'DELETE'])!!}
              <p>¿Estas seguro que deseas quitar Indicador a <b>{{$indicador->nombre}}?</b></p>
      </div>
      <div class="modal-footer modal-delete-footer">
            <a  data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
            {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
      </div>
      {!! Form::close()!!}
    </div>

  </div>
</div>