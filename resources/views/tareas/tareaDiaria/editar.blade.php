
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-editar">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Nueva Tarea
      </div>
      <div class="modal-body modal-delete-body">
               {!!Form::model($tarea, ['route'=>['tareas.tareaDiaria.update', $tarea->id], 'method'=>'PUT'])!!}

              {{-- Descripcion --}}
              <div class="col-sm-12">
                <br>
                <div class="form-group @if ($errors->has('descripcion')) has-error @endif  col-sm-10">
                    <label for="descripcion">Descripcion </label>
                    <input type="text" minlength="5" maxlength="60" name="descripcion"  value="{{ $tarea->descripcion }}" placeholder="Ingresa la descripcion" class="form-control" required>
                    @if ($errors->has('descripcion')) <p class="help-block">{{ $errors->first('descripcion') }}</p> @endif
                </div>
              </div>
                 
      </div>
      <div class="modal-footer modal-delete-footer">
        <br>
        <a  data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
        {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
      </div>
      {!! Form::close()!!}
    </div>

  </div>
</div>
