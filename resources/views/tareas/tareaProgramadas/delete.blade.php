
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-delete-{{$tarea->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Eliminar Tarea
      </div>
      <div class="modal-body modal-delete-body">
           {!!Form::open(['action'=>['Tareas\TareaProgramadaController@destroy', $tarea->id], 'method'=>'DELETE'])!!}
            <div class="modal-body">
              <p>¿Estas seguro que deseas eliminar a <b>{{$tarea->descripcion}}?</b></p>
                 
            </div>
            <div class="modal-footer modal-delete-footer">
              <a  data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
            <button type="submit" name="guardar" @click="mostrarModalLoading()" class="btn btn-success"><span class="fa fa-check"></span> Guardar</button>


            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>
