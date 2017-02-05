
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-delete-{{$proyecto->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Eliminar proyecto
      </div>
      <div class="modal-body modal-delete-body">
           {!!Form::open(['action'=>['Tareas\ProyectoController@destroy', $proyecto->id], 'method'=>'DELETE'])!!}
            <div class="modal-body">
              <p>¿Estas seguro que deseas eliminar a <b>{{$proyecto->nombre}}?</b></p>
                  <div class="form-group col-sm-5 ">
                        <label id="nombregrupo"></label>
                  </div>
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
