
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-delete-{{$item->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Eliminar Grupo Departamento
      </div>
      <div class="modal-body modal-delete-body">
           {!!Form::open(['action'=>['GrupoDepartamentoController@destroy', $item->id], 'method'=>'DELETE'])!!}
            <div class="modal-body">
              <p>¿Estas seguro que deseas eliminar a {{$item->nombre}}?</p>
                  <div class="form-group col-sm-5 ">
                        <label id="nombregrupo"></label>
                  </div>
            </div>
            <div class="modal-footer modal-delete-footer">
                  <a data-dismiss="modal" class="btn btn-danger btn-sm">Cancelar</a>
                  {!! form::submit('Aceptar',['name'=>'Aceptar','id'=>'aceptar','content'=>'<span>Aceptar</span>','class'=>'btn btn-success btn-sm']) !!}
            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>

