
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-cancelar-{{$tarea->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Reabrir la Tarea</b>
      </div>
      <div class="modal-body modal-delete-body" style="padding: 0px;">
           {!!Form::open(['action'=>['Tareas\TareaProgramadaController@cancelarSolucion', $tarea->id], 'method'=>'GET'])!!}
            <div class="modal-body">
              <p>¿Estas seguro que deseas Reabrir la tarea ?</p>
                 
            </div>
            <div class="modal-footer modal-delete-footer">
              <a  data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
              {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>
