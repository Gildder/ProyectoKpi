
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-nota-{{$item->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Agregando Tarea Nro. {{$item->id}}</b>
      </div>
      <div class="modal-body modal-delete-body">
         {!!Form::open(['action'=>['Supervisores\SupervisadosController@agregarErrorTarea',  $empleado_id], 'method'=>'GET'])!!}

          <div class="modal-body">

              <p>La justificacion es necesaria para registrar un error de una tarea.</p>

              
                <label for="descripcion" @if ($errors->has('descripcion')) has-error @endif >Justificacion</label>
                <textarea type="textArea" name="descripcion" maxlength="120" placeholder="Agrega tu justificacion para la tarea observada" class="form-control" rows="5" cols="9" required></textarea>
                @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif

                <input type="text" name="tarea_id" value="{{$item->id}}" hidden>
          </div>
        <div class="modal-footer modal-delete-footer">
      
          <a  data-dismiss="modal" class="btn btn-danger btn-sm" ><span class="fa fa-times"></span> Cancelar</a>
          {!! form::button('<i class="fa fa-check"></i> Guardar',['name'=>'Guardar', 'id'=>'guardar', 'class'=>'btn btn-success btn-sm', 'type'=>'submit' ]) !!}
        </div>
        {!! Form::close()!!}
      </div>
    </div>
  </div>
</div>
