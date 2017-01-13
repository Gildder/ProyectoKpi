
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-delete-{{$empleados->codigo}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Baja de Empleado
      </div>
      <div class="modal-body modal-delete-body">
           {!!Form::open(['action'=>['EmpleadoController@destroy', $empleados->codigo], 'method'=>'DELETE'])!!}
            <div class="modal-body">
              <p>¿Estas seguro que deseas dar de Baja a <b>{{$empleados->nombres}}  {{$empleados->apellidos}}</b>?</p>
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
