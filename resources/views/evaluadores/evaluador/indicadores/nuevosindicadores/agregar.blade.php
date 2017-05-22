
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-agregar">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Agregar Nuevo Indicador</b>
      </div>
      <div class="modal-body modal-delete-body">
           {!!Form::open(['action'=>['_TablaMes', $evaluador->id], 'method'=>'GET'])!!}
            <div class="modal-body">
              <p>Seleccionar indicadores que desea agregar a <b>{{$evaluador->abreviatura}}</b></p>

              @include('evaluadores/evaluador/indicadores/nuevosindicadores/tabla_disponibles')
            </div>
            <div class="modal-footer modal-delete-footer">
              <a id="cancelar"  data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>

              {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit', 'disabled' => 'disabled'  ]) !!}
            </div>
            {!! Form::close()!!}
      </div>
    </div>

  </div>
</div>
