
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-deleteCargoSupervisor-{{ $item->id }}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Quitar Empleado</b>
      </div>
      <div class="modal-body modal-delete-body">
           {!!Form::open(['action'=>['Supervisores\SupervisorController@quitarcargo', $item->id, $lista->id], 'method'=>'GET'])!!}
            <div class="modal-body">
              <p>¿Estas seguro que deseas quitar a <b>{{$item->id}} {{$item->usuario}}</b>?</p>
            </div>
            <div class="modal-footer modal-delete-footer">
              <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>
              {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit' ]) !!}
            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>
