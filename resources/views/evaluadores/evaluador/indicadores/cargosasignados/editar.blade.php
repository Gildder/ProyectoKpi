<script>
  $(document).ready(function() {

  });
</script>


   <!-- Modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" tabindex="-1" role="dialog" id="modal-editarcargo-{{$item->id}}">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-delete-content modal-content ">
      {{-- Header --}}
      <div class="modal-header modal-delete-header" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <b>Editar Cargo</b>
      </div>

      {{-- Body --}}
      <div class="modal-body modal-delete-body">
         {!!Form::open(['action'=>['Evaluadores\EvaluadorController@editarcargoasignado', $indicador->id, $evaluador->id, $item->id], 'method'=>'GET'])!!}
          <div class="modal-body">
            @include('evaluadores/evaluador/indicadores/cargosasignados/data_edit');
          </div>
      </div>
      {{-- Footer --}}
      <div class="modal-footer modal-delete-footer">
        <a  data-dismiss="modal" class="btn btn-danger"  ><span class="fa fa-times"></span> Cancelar</a>

        <button type="submit" @click="mostrarModalLoading()"  class="btn btn-success guardar" type="reset"><span class="fa fa-save"></span> Guardar</button>
      </div>
      {!! Form::close()!!}
    </div>

  </div>
</div>
