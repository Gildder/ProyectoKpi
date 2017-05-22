
   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="agregarcargo">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      {{-- Header --}}
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Agregar Cargo</b>
      </div>

      {{-- Body --}}
      <div class="modal-body modal-delete-body">
           {!!Form::open(['action'=>['_TablaMes', $indicador->id, $evaluador->id], 'method'=>'GET'])!!}
            <div class="modal-body">
              @include('evaluadores/evaluador/indicadores/cargosasignados/data_create');
            </div>
      </div>
      {{-- Footer --}}
      <div class="modal-footer modal-delete-footer">
        <a  data-dismiss="modal" class="btn btn-danger" ><span class="fa fa-times"></span> Cancelar</a>

        {!! form::button('<i class="fa fa-check"></i> Aceptar',['name'=>'aceptar', 'id'=>'aceptar', 'content'=>'<span>Aceptar</span>', 'class'=>'btn btn-success', 'type'=>'submit'  ]) !!}
      </div>
      {!! Form::close()!!}
    </div>

  </div>
</div>
